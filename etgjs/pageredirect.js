var CookieManager = {
    createCookie: function (name, value, days) {
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            var expires = "; expires=" + date.toGMTString();
        }
        else var expires = "";
        document.cookie = name + "=" + value + expires + "; path=/";
    },
    readCookie: function (name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    },
    eraseCookie: function (name) {
        createCookie(name, "", -1);
    }
};
var NavLocationTrackCName = "NavigationCookie";
var authDeniedMessage = "Authorization has been denied for this request.";
var navigatepath = function (url) {
    if (navigator.userAgent.match(/MSIE\s(?!9.0)/)) {
        var referLink = document.createElement("a");
        referLink.href = url;
        document.body.appendChild(referLink);
        referLink.click();
    }     // All other browsers
    else { window.location.replace(url); }
}
var loginUser = function ()//checks to see if the user is logged in and if logged in redirects to the home page
{
    //simply redirects to the home page....is not logged in the home will auto log out the user
    try {
        navigatepath("/Views/Home/main.aspx");
    }
    catch (err) {
        throw err;
    }
}
var lockUserScreen = function ()//checks to see if the user is logged in and if logged in redirects to the home page
{
    //simply redirects to the home page....is not logged in the home will auto log out the user
    try {
        navigatepath("/Views/UITemplate/screenlocker.aspx");
    }
    catch (err) {
        throw err;
    }
}
var LogOutUser = function ()//call some method from the server that closes the current session associated with the current user
{
    //call some controller action to log out the user and then manually log out the user
    //
    try {

        $.ajax
          ({
              type: "POST",
              url: '/SystemAccounts/Authentication/Login/LogOut',
              dataType: "json",
              contentType: "application/json; charset=UTF-8",
          }).done(function (data, status, jqXhr) {
              try {
                  try {
                      navigatepath("/Views/SystemAccounts/Authentication/login.aspx");
                  }
                  catch (Err) {
                      alert("An error occured while attempting to log out the user:\nReason :", Err.message);
                  }
              }
              catch (err) {
                  alert(err.message);
              }

          }).fail(function (jqXhr) {
              var data = null;
              try {
                  navigatepath("/Views/SystemAccounts/Authentication/login.aspx");
              }
              catch (error) {
                  alert(error.message);
              }
          });
    }
    catch (error) {
        alert(error.message)
    }

}
var handlerStatusCodeGeneral = function (statusCode) {
    switch (statusCode) {
        //hande the unauthorized error message by redirecting to the log in page
        case 401:
            {
                //LogOutUser();
                break;
            }
    }
}
var homeScreenModuleName = "Home";
var lockScreenModuleName = "locker";
var LoginScreenModuleName = "Login";
function checkLoggedIn(asyncState, callingModule) {

    $.ajax({
        type: "POST",
        async: asyncState,
        url: '/SystemAccounts/Authentication/UserProfile/CheckLoggedIn',
        dataType: "json",
        contentType: "application/json; charset=UTF-8",
        beforeSend: function (xhr) {
            try {
                var toSend = ExecutionResultMajor.processHeader(ExecutionResultMajor);
                if (toSend) {
                    xhr.setRequestHeader(toSend.headerVal, toSend.Value);
                }
            }
            catch (err) {
                alert(err.message);
            }

        }

    }).done(function (data, status, jqXHR) {
        var statusCode = jqXHR.status;//call a generic status code handler that will only sort the auth header if invalid
        try {
            try {

                try {
                    var actualData = data.Result;
                    debugger;
                    if (actualData.Message.toLowerCase() == "screen locked") {
                        //redirect to the lock screen page
                        if ((callingModule === lockScreenModuleName) == false) {
                            if ((callingModule === LoginScreenModuleName) == false)//only the login module can can prevent lock from happening
                                lockUserScreen();
                        }
                    }
                    else if (actualData.Message.toLowerCase() === "login successfull") {
                        if ((callingModule === LoginScreenModuleName) == true)
                            loginUser();
                    }
                    else if (actualData.Message.toLowerCase() === "login successfull") {
                        //if ((callingModule === homeScreenModuleName) == false)
                        //loginUser();
                    }
                    else {
                        LogOutUser();//simply log out the user just incase
                    }
                }
                catch (error) {
                    alert(Error.message);
                }
            }
            catch (ex) {
                alert(ex.message);
            }
        }
        catch (err) {
            alert(err.message);
        }
        //do nothing
    }).fail(function (jqXHR) {
        var statusCode = jqXHR.status;//call a generic status code handler that will only sort the auth header if invalid
        if ((callingModule === LoginScreenModuleName) == false)
            LogOutUser();

    });

}
var sleep = function (millis, callback) {
    setTimeout(function ()
    { callback(); }
    , millis);
}
var sleepInitialLogin = function (millis, callback) {
    setTimeout(function ()
    { callback(true); }
    , millis);
}
var setServerTokenFromResponse = function (jqXHR) {
    var AuthHeaderResponse = jqXHR.getResponseHeader("Authorization");
    AuthHeaderResponse = "Authorization: " + AuthHeaderResponse;
    ExecutionResultMajor.AuthHeader = AuthHeaderResponse;
    return AuthHeaderResponse;
}
var KendoGridHelper = {
    oGlobal: null,
    Result:
        {
            CurrentRowIndex: -1,
            CurrentColumnIndex: -1,
        },
    onChange: function (oParam, oThis) {
        "use strict";
        var self = this;
        var that = oThis, sThisDay = "";
        var iRowIndex = -1, iColIndex = -1;
        var selected = $.map(this.select(), function (item) {
            var arrElements = $(item).parent().children();
            var iCounter = 0, iLength = 0
            var arrParentElements = $(item).parent().parent().children();
            var oCurrentParent = $(item).parent();
            var iPageOffset = 0;
            if (oParam && oParam.sender && oParam.sender.pager && oParam.sender.pager.dataSource && oParam.sender.pager.dataSource._page && oParam.sender.pager.dataSource._pageSize) {
                iPageOffset = ((oParam.sender.pager.dataSource._page - 1) * oParam.sender.pager.dataSource._pageSize);
            }
            iRowIndex = $.inArray(oCurrentParent[0], arrParentElements) + iPageOffset;
            iLength = arrElements.length;
            for (iCounter = 0; iCounter < iLength; iCounter++) {
                if (arrElements[iCounter] === item) {
                    iColIndex = iCounter;
                    self.Result.CurrentRowIndex = iRowIndex;
                    self.Result.CurrentColumnIndex = iColIndex;
                    //alert("Row Number: " + iRowIndex + ", Col Number: " + iColIndex);
                    break;
                }
            }
        });
        return false;
    }
}
var ExecutionResultMajor = {
    ModuleName: "",
    Result: {
        IsOkay: true,
        Message: "Login Failed",
        Result: null,
    },
    AuthHeader: "",
    processHeader: function (ExecutionResultMajor) {
        try {
            var result = {
                headerVal: "",
                Value: ""
            };
            var indexofspace = ExecutionResultMajor.AuthHeader.indexOf(':');
            result.headerVal = ExecutionResultMajor.AuthHeader.slice(0, indexofspace);
            result.Value = ExecutionResultMajor.AuthHeader.slice(indexofspace + 1);
            //alert(result.headerVal + " body" + result.Value);
            return result;
        }
        catch (err) {
            alert("An error occured,Error Message:" + err.message);
            return null;
        }


    }
}

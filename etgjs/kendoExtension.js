var KendoCustomExtensions = {
    initcheckChangeManual: function () {
        try {
            kendo.data.binders.checkChangeManual = kendo.data.Binder.extend({
                init: function (element, bindings, options) {
                    //call the base constructor
                    kendo.data.Binder.fn.init.call(this, element, bindings, options);

                    var that = this;
                    //listen for the change event of the element
                    $(that.element).on("change", function () {
                        that.change(); //call the change function
                    });
                },
                refresh: function () {
                    var that = this,
                        value = that.bindings["checkChangeManual"].get(); //get the value from the View-Model

                    $(that.element).val(value); //update the HTML input element
                    //set the checked attribute
                    try {
                        debugger;
                        if (value == true) {
                            $(that.element).attr('checked', 'checked');
                            $(that.element).val(value);
                            try {
                                that.element.parentElement.className = "checked";
                            }
                            catch (err) {

                            }
                        }
                        else {
                            $(that.element).val(value);
                            $(that.element).removeAttr('checked');
                            try {
                                that.element.parentElement.className = "";
                            }
                            catch (err) {

                            }
                        }
                    }
                    catch (err) {
                        alert(err.message);
                    }
                },
                change: function () {
                    debugger;
                    try {
                        var value = this.element.value;
                        var setValue = false;
                        if (value === false || value === 'false')
                            setValue = true;
                        else
                            setValue = false;
                        this.bindings["checkChangeManual"].set(setValue); //update the View-Model

                    }
                    catch (err) {
                        alert(err.message);
                    }
                }
            });
        }
        catch (err) {
            alert(err.message);
        }
    },
}
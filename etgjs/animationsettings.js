var animationController = function animationController() {
    var timeout = null;
    var delayBy = 200; //Number of milliseconds to wait before ajax animation starts.

    var pub = {};

    var actualAnimationStart = function actualAnimationStart() {
        $("#busyIndicator").css("display", "block");
    };

    var actualAnimationStop = function actualAnimationStop() {
        $("#busyIndicator").css("display", "none");
    };

    pub.startAnimation = function animationController$startAnimation() {
        timeout = setTimeout(actualAnimationStart, delayBy);
    };

    pub.stopAnimation = function animationController$stopAnimation() {
        //If ajax call finishes before the timeout occurs, we wouldn't have 
        //shown any animation.
        clearTimeout(timeout);
        actualAnimationStop();
    }

    return pub;
}();

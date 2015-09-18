function AutoResizeImage(maxWidth, maxHeight, objImg) {
    var img = new Image();
    img.src = objImg.src;
    var hRatio;
    var wRatio;
    var Ratio = 1;
    var w = img.width;
    var h = img.height;
    wRatio = maxWidth / w;
    hRatio = maxHeight / h;
    if (maxWidth == 0 && maxHeight == 0) {
        Ratio = 1;
    } else if (maxWidth == 0) {
            Ratio = hRatio;
    } else if (maxHeight == 0) {
            Ratio = wRatio;
    } else {
        Ratio = (wRatio <= hRatio ? wRatio : hRatio);
    }
    w = w * Ratio;
    h = h * Ratio;
    objImg.height = h;
    objImg.width = w;
}

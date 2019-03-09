function addCroppic(baseUrl, elemId, outputId, loadImg, is_source){
    var uplodData = {"baseUrl": baseUrl};

    var cropData = {};
    if(is_source != undefined)
        cropData.is_source = is_source;

    var cropperOptions = {
        doubleZoomControls: false,
        uploadUrl: baseUrl + "/js/croppic/img_save_to_file.php",
        uploadData: uplodData,
        cropUrl: baseUrl + "/js/croppic/img_crop_to_file.php",
        cropData: cropData,
        loadPicture: (loadImg == undefined) || (loadImg.length == 0) || (loadImg == '/img/default_img.jpeg') ? '' : baseUrl + '/' + loadImg,
        outputUrlId: outputId,
        modal:false,
        loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
        onBeforeImgUpload: function(){$('#croppic_div_a').next('.validation_errors').empty()},
        onError:		function(error_msg){$('#croppic_div_a').next('.validation_errors').text(error_msg)}
    }
    new Croppic(elemId, cropperOptions);
}
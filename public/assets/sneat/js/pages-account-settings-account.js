/**
 * Account Settings - Account
 */

'use strict';
document.addEventListener('DOMContentLoaded', function (e) {
  (function (){
    // Update/reset user image of account page
    let uploaded = document.getElementById('img_logo');
    const fileInput = document.querySelector('.file-input');
    const resetFileInput = document.querySelector('.image-reset');

    if (uploaded) {
      const resetImage = uploaded.src;
      fileInput.onchange = () => {
        if (fileInput.files[0]) {
          uploaded.src = window.URL.createObjectURL(fileInput.files[0]);
        }
      };
      resetFileInput.onclick = () => {
        fileInput.value = '';
        uploaded.src = resetImage;
      };
    }
  })();
});

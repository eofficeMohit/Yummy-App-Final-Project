Dropzone.autoDiscover=!1,$(function(){"use strict";var e=$("#dpz-single-file"),i=$("#dpz-multiple-files"),l=$("#dpz-btn-select-files"),a=$("#dpz-file-limits"),m=$("#dpz-accept-files"),o=$("#dpz-remove-thumb"),p=$("#dpz-remove-all-thumb");e.dropzone({paramName:"file",maxFiles:1}),i.dropzone({paramName:"file",maxFilesize:.5,clickable:!0}),l.dropzone({clickable:"#select-files"}),a.dropzone({paramName:"file",maxFilesize:.5,maxFiles:5,maxThumbnailFilesize:1}),m.dropzone({paramName:"file",maxFilesize:1,acceptedFiles:"image/*"}),o.dropzone({paramName:"file",maxFilesize:1,addRemoveLinks:!0,dictRemoveFile:" Trash"}),p.dropzone({paramName:"file",maxFilesize:1,init:function(){var e=this;$("#clear-dropzone").on("click",function(){e.removeAllFiles()})}})});

// "use strict";
HTMLDivElement.prototype.show = function (){
    this.style.display = 'block'
}

HTMLDivElement.prototype.hide = function (){
    this.style.display = 'none'
}

const input_load = document.getElementById('photo-input');
const photoPreview = document.querySelector('.photoPreview');
const loadInfo = document.querySelector('.load-info');

const btnLoad = document.querySelector('.btn-publish');

//
// btnLoad.addEventListener('click', function() {
//     $.ajax({
//         type: "POST",
//         url: "/img_load2.php",
//         //url: "../testt.php",
//         processData: false,
//         contentType: false,
//         data: 'fd',
//         cache: false,
//         success: function(html) {
//             // if (html == "") {
//             //     window.location = '/index.php';
//             //     console.log('dgdfgffd')
//             //     // error_load.innerHTML = html;
//             //
//             // } else {
//             //     // error_load.innerHTML = html;
//             //     console.log('dgdfgffd')
//             // }
//             console.log(html)
//         }
//     });
// })

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#prevImage').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
// $("#imageFile").change(function() {
//     readURL(this);
// });

input_load.addEventListener('change', function () {
    loadInfo.style.display = 'none'
    photoPreview.style.display = 'grid'
    readURL(this)

    // let filesArr = this.files
    // let fileItems = document.querySelectorAll('.file-item')
    // fileItems.forEach(item => item.remove())
    // console.log('rest')
    //
    // Array.prototype.forEach.call(filesArr, file => {
    //     let fileName = file.name;
    //     let fileSize =  (parseFloat(file.size) / 1000).toFixed(1);
    //     let files = document.querySelector('.files')
    //
    //     let fileItem = document.createElement('div')
    //     fileItem.classList.add('file-item')
    //
    //     let fileNameDiv = document.createElement('div')
    //     fileNameDiv.classList.add('file-name')
    //     fileNameDiv.textContent = fileName
    //
    //     let fileSizeDiv = document.createElement('div')
    //     fileSizeDiv.classList.add('file-size')
    //     fileSizeDiv.textContent = fileSize + " KB"
    //
    //     let fileCloseImg = document.createElement('img')
    //     fileCloseImg.setAttribute('src', 'assets/img/close-svg.svg')
    //     fileCloseImg.addEventListener('click', (e) => {
    //         let fileNameDelete = e.target.parentNode.querySelector('.file-name').innerText
    //         e.target.parentNode.remove()
    //         let dt = new DataTransfer();
    //         let filesPrev = [...input_load.files]
    //         let fileToDelete = filesPrev.indexOf(filesPrev.find(value => value.name == fileNameDelete))
    //
    //         filesPrev.splice(fileToDelete, 1)
    //
    //         filesPrev.forEach((item) => {
    //             dt.items.add(item);
    //         })
    //
    //         input_load.files = dt.files
    //         // console.log(input_load.files)
    //         // console.log(input_load.files)
    //
    //     })
    //     fileItem.appendChild(fileNameDiv)
    //     fileItem.appendChild(fileSizeDiv)
    //     fileItem.appendChild(fileCloseImg)
    //
    //     files.appendChild(fileItem)
    //     btnLoad.classList.add('active')
    // });
    //
    // console.log(this.files)
});




btnLoad.addEventListener('click', function() {
    if (btnLoad.classList.contains('active-load')) {
        const fff = document.querySelector('#form-addPhoto');
        const $input = $("#photo-input");
        const fd = new FormData;
        // const tags = fff.tag.value.split(',')
        fd.append('img_load', $input.prop('files')[0]);
        fd.append('description', fff.description.value);
        // for (let i = 0; i < tags.length; i++)
        //     console.log(tags[i]);

        $.ajax({
            type: "POST",
            url: "../img_load.php",
            //url: "../testt.php",
            processData: false,
            contentType: false,
            data: fd,
            cache: false,
            success: function(html) {
                if (html == "") {
                    window.location = '../index.php';
                    // error_load.innerHTML = html;

                } else {
                    // error_load.innerHTML = html;
                }
                console.log(html)
            }
        });
        return false;
    }
});

const deleteImg = document.getElementById('deleteImage')
deleteImg.addEventListener('click',  function () {
    input_load.value = ''
    loadInfo.style.display = 'block'
    photoPreview.style.display = 'none'
})

const formLoad = document.getElementById('form-addPhoto')

const formLoadInputs = document.querySelectorAll('.form-loadInput')

formLoadInputs.forEach((item) => item.addEventListener('input', () => check_load_fields()))

function check_load_fields() {
    if (formLoad.description.value !== "" && formLoad.file.value !== "") {
        btnLoad.classList.add('active-load');
    } else {
        btnLoad.classList.remove('active-load');
    }
}

// let dropArea = document.querySelector('.fileLoad-area')
// dropArea.addEventListener('dragover', function (e) {
//     e.preventDefault()
//     e.stopPropagation()
//     this.classList.add('dragging')
// })
//
// dropArea.addEventListener('dragleave', function (e) {
//     e.preventDefault()
//     e.stopPropagation()
//     this.classList.remove('dragging')
// })
//
// dropArea.addEventListener('drop', function (e) {
//     e.preventDefault()
//     e.stopPropagation()
//     this.classList.remove('dragging')
//
//     let dt = e.dataTransfer
//     let files = dt.files
//
//     let fileItems = document.querySelectorAll('.file-item')
//     fileItems.forEach(item => item.remove())
//
//     input_load.files = files
//
//     Array.prototype.forEach.call(files, file => {
//         let fileName = file.name;
//         let fileSize =  (parseFloat(file.size) / 1000).toFixed(1);
//         let files = document.querySelector('.files')
//
//         let fileItem = document.createElement('div')
//         fileItem.classList.add('file-item')
//
//         let fileNameDiv = document.createElement('div')
//         fileNameDiv.classList.add('file-name')
//         fileNameDiv.textContent = fileName
//
//         let fileSizeDiv = document.createElement('div')
//         fileSizeDiv.classList.add('file-size')
//         fileSizeDiv.textContent = fileSize + " KB"
//
//         let fileCloseImg = document.createElement('img')
//         fileCloseImg.setAttribute('src', 'assets/img/close-svg.svg')
//         fileCloseImg.addEventListener('click', (e) => {
//             let fileNameDelete = e.target.parentNode.querySelector('.file-name').innerText
//             e.target.parentNode.remove()
//             let dt = new DataTransfer();
//             let filesPrev = [...input_load.files]
//             let fileToDelete = filesPrev.indexOf(filesPrev.find(value => value.name == fileNameDelete))
//
//             filesPrev.splice(fileToDelete, 1)
//
//             filesPrev.forEach((item) => {
//                 dt.items.add(item);
//             })
//
//             input_load.files = dt.files
//
//         })
//         fileItem.appendChild(fileNameDiv)
//         fileItem.appendChild(fileSizeDiv)
//         fileItem.appendChild(fileCloseImg)
//
//         files.appendChild(fileItem)
//         btnLoad.classList.add('active')
//     });
// })




// const filesTest = [
//     {
//         name: 'one',
//         x: '32223'
//     },
//     {
//         name: 'two',
//         x: '4353464'
//
//     }]
//
// console.log(filesTest.find(value => value.name == 'one'))
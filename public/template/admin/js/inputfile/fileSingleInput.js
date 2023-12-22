const fileSingleInput = document.getElementById('fileSingleInput');
const fileSingleList = document.getElementById('fileSingleList');

fileSingleInput.addEventListener('change', function () {
    fileSingleList.innerHTML = ''; // Clear previous file list
    const files = fileSingleInput.files;

    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        file.index = i;
        const wrapItem = document.createElement('div');
        wrapItem.classList.add('wrap-item');
        const infoItem = document.createElement('div');
        infoItem.classList.add("left-item");
        infoItem.innerHTML = `<p class="title-file">${file.name}</p> <small>${formatFileSize(file.size)}</small>`; // thêm
        const removeButton = document.createElement('span');
        removeButton.classList.add('remove-file');
        removeButton.innerHTML = ` <i class="fa-solid fa-trash-can"></i>`;
        infoItem.appendChild(removeButton);

        removeButton.addEventListener('click', function () {
            const newFiles = Array.from(fileSingleInput.files);
            newFiles.splice(file.index, 1); // Remove the file from the input element
            const dataTransfer = new DataTransfer();
            newFiles.forEach(function (file , index) {
                file.index = index;
                dataTransfer.items.add(file);
            });
            fileSingleInput.files = dataTransfer.files;
            wrapItem.remove(); // Remove the file item from the preview
        });
        fileSingleList.appendChild(wrapItem);
        const reader = new FileReader();
        reader.onload = function (e) {
            const imgPreview = document.createElement('div');
            imgPreview.classList.add('image-item');
            imgPreview.innerHTML = `<img src="${e.target.result}" class="preview" alt="">`;
            wrapItem.appendChild(imgPreview);
            wrapItem.appendChild(infoItem);
        };
        reader.readAsDataURL(file);
    }

});

function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
    const i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
    return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
}

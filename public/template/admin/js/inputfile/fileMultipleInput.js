const fileMultipleInput = document.getElementById('fileMultipleInput');
const fileMultipleList = document.getElementById('fileMultipleList');

var oldFile = [];
fileMultipleInput.addEventListener('change', function () {
    // fileMultipleList.innerHTML = ''; // Clear previous file list
    const files = fileMultipleInput.files;

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
            const newFiles = Array.from(fileMultipleInput.files);
            newFiles.splice(file.index, 1); // Remove the file from the input element
            const dataTransfer = new DataTransfer();
            newFiles.forEach(function (file , index) {
                file.index = index;
                dataTransfer.items.add(file);
            });
            fileMultipleInput.files = dataTransfer.files;
            oldFile = fileMultipleInput.files;
            wrapItem.remove(); // Remove the file item from the preview
        });
        fileMultipleList.appendChild(wrapItem);
        const reader = new FileReader();
        reader.onload = function (e) {
            // <div class="image-item"></div>
            const imgPreview = document.createElement('div');
            imgPreview.classList.add('image-item');
            imgPreview.innerHTML = `<img src="${e.target.result}" class="preview" alt="">`;
            // const imgPreview = document.createElement('img');
            // imgPreview.classList.add('preview');
            // imgPreview.src = e.target.result;
            wrapItem.appendChild(imgPreview);
            wrapItem.appendChild(infoItem);
        };
        reader.readAsDataURL(file);
    }

    if (oldFile.length > 0) {
        var mergeNew = Array.from(fileMultipleInput.files);
        var mergeOld = Array.from(oldFile);
        var mergeFile = [...mergeOld, ...mergeNew];
        var newf = [];
        mergeFile.forEach((element,index) => {
            element.index = index;
            newf.push(element);
        });

        let result = newf.filter(
        (person, index) => index === newf.findIndex(
            other => person.name === other.name
            && person.size === other.size
        ));

        const dataTransfer = new DataTransfer();
        result.forEach(function (file , index) {
            file.index = index;
            dataTransfer.items.add(file);
        });
        fileMultipleInput.files = dataTransfer.files;


        let dupes = {};
        newf.forEach((item,index) => {
            dupes[item.name+item.size] = dupes[item.name+item.size] || [];
            dupes[item.name+item.size].push(index);
        });
        var divElements = document.getElementsByClassName("wrap-item");
        var mergeFileReverse = []
        for(let name in dupes)
        {
            var removeArr = dupes[name];
            if (removeArr.length > 1) {
                removeArr.shift();
                mergeFileReverse.push(...removeArr);
            }
        }
        mergeFileReverse.reverse().forEach(element => {
            divElements[element].remove();
        });
    }

    oldFile = fileMultipleInput.files;

});

function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
    const i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
    return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
}

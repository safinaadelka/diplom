// Инициализация Cropper.js
const image = document.getElementById("image");
console.log(image);
const cropper = new Cropper(image, {
  aspectRatio: 16 / 9,
  viewMode: 2,
  autoCropArea: 1,
  background: false,
});

// Скрыть кнопку "Обрезать изображение" при загрузке страницы
document.getElementById("cropButton").style.display = "none";

// Обработчик события загрузки изображения
document.getElementById("fileInput").addEventListener("change", function (e) {
  const file = e.target.files[0];
  const reader = new FileReader();

  reader.onload = function (e) {
    image.src = e.target.result;
    cropper.replace(e.target.result);

    // Показать кнопку "Обрезать изображение" после выбора изображения
    document.getElementById("cropButton").style.display = "block";
    document.getElementById("cropper_image_place").style.display = "block"; 
    document.querySelector(".itog_image").style.display = "none";
  };

  reader.readAsDataURL(file);
});

// Обработчик кнопки "Обрезать изображение"
document.getElementById("cropButton").addEventListener("click", function () {
  const croppedCanvas = cropper.getCroppedCanvas();
  const croppedImage = croppedCanvas.toDataURL("image/jpeg");

  // находим элементы с этим классом,
  itog_image = document.querySelectorAll(".itog_image");

  if (itog_image.length > 0) {
    console.log("nooo");
    // удаляем все обьекты с этим классом, если оно существует

    itog_image.forEach((element) => {
      element.remove();
    });

    const outputImg = document.createElement("img");
    outputImg.classList.add("itog_image");
    outputImg.src = croppedImage;
    document.querySelector(".modal_add_right").appendChild(outputImg);
    console.log("delete cropper 1");

    document.getElementById("cropper_image_place").style.display = "none"; 

    cropper.destroy();
  }
  if (itog_image.length === 0) {
    console.log("yess");
    // еще нет старой фотки

    const outputImg = document.createElement("img");
    outputImg.classList.add("itog_image");
    outputImg.src = croppedImage;
    document.querySelector(".modal_add_right").appendChild(outputImg);
    console.log("delete cropper 2");

    document.getElementById("cropper_image_place").style.display = "none"; 


    cropper.destroy();
  }

  cropper.destroy();
  console.log("delete cropper 3");
  // Скрыть область обрезки и кнопку после обрезки изображения

  document.getElementById("cropButton").style.display = "none";
  document.querySelector(".cropper-container").style.display = "none";
  document.getElementById("cropper_image_place").style.display = "none"; 

  // Выводим обрезанное изображение на страницу или выполняем другие действия
});

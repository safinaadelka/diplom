const formData = new FormData();
formData.append("file", e.blob(), e.filename());

const xhr = new XMLHttpRequest();
xhr.open("POST", "/assets/lesson_img", true);
xhr.onload = function() {
    if (xhr.status === 200) {
        console.log("Файл успешно загружен на сервер");
    } else {
        console.error("Произошла ошибка при загрузке файла");
    }
};

xhr.send(formData);



const express = require('express');
const multer = require('multer');
const path = require('path');
const app = express();

// Настройка Multer для сохранения загруженных файлов
const storage = multer.diskStorage({
  destination: function (req, file, cb) {
    cb(null, '/assets/lesson_img');
  },
  filename: function (req, file, cb) {
    cb(null, file.fieldname + '-' + Date.now() + path.extname(file.originalname));
  }
});

const upload = multer({ storage: storage });

// Обработчик загрузки изображений
app.post('/assets/lesson_img', upload.single('image'), (req, res) => {
  if (!req.file) {
    return res.status(400).send('Ошибка: Файл не загружен.');
    console.log("Ошибка: Файл не загружен."); 
  }

  const imageUrl = '/assets/lesson_img/' + req.file.filename;
  res.json({ location: imageUrl });
});

// Запуск сервера
const port = 3000;
app.listen(port, () => {
  console.log("Сервер запущен на порту ${port}");
});
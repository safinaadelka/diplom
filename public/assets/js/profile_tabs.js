// Получаем все вкладки и их содержимое
const tabs = document.querySelectorAll(".tab-content");

tab_links = document.querySelectorAll(".profile_nav_link");
// const tabContents = document.querySelectorAll(".tab-content");

// Проверяем localStorage на наличие сохраненной вкладки
// const lastTab = localStorage.getItem("lastTab");

// // Если есть сохраненная вкладка, показываем её
// if (lastTab) {
//   tabContents.forEach((tabContent) => {
//     if (tabContent.id === lastTab) {
//       tabContent.style.display = "block";
//     } else {
//       tabContent.style.display = "none";
//     }
//   });
// }

// // Добавляем обработчики событий для вкладок
// tabs.forEach((tab) => {
//   tab.addEventListener("click", (e) => {

//     tabs.forEach((tab) => {
//         tab.classList.remove("profile_nav_link_active");
//         e.preventDefault();
//     })
//     tab.classList.add("profile_nav_link_active");

//     const tabId = tab.getAttribute("data-tab");
//     // tab.classList.toggle("profile_nav_link_active");
//     // Скрываем все вкладки и показываем только выбранную
//     tabContents.forEach((tabContent) => {
//       if (tabContent.id === tabId) {
//         tabContent.style.display = "block";
//       } else {
//         tabContent.style.display = "none";
//       }
//     });

//     // Сохраняем выбранную вкладку в localStorage
//     localStorage.setItem("lastTab", tabId);
//   });
// });
const sideMenu = document.getElementById("profile_nav");

function isMobileDevice() {
  return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
    navigator.userAgent
  );
}

// При клике на ссылку (tab)
document
  .querySelectorAll(".profile_nav_link")
  .forEach(function (tabLink, index) {
    tabLink.addEventListener("click", function () {
      // Сохраняем индекс выбранной вкладки в local storage
      localStorage.setItem("activeTab", index);

      // Устанавливаем активный класс для выбранной ссылки (tab)
      document.querySelectorAll(".profile_nav_link").forEach(function (link) {
        link.classList.remove("profile_nav_link_active");
      });
      tabLink.classList.add("profile_nav_link_active");

      tabs.forEach(function (tab) {
        tab.style.display = "none";
      });
      tabs[index].style.display = "block";


      if (isMobileDevice()) {
        sideMenu.style.left = "-100%";
        console.log("Вы используете мобильное устройство");

      }

      // Дополнительно, можно обновить содержимое вкладки
    });
  });

// При загрузке страницы
document.addEventListener("DOMContentLoaded", function () {
  // Проверяем, есть ли сохраненная информация о выбранной вкладке
  const activeTab = localStorage.getItem("activeTab");

  if (activeTab !== null) {
    // Устанавливаем активный класс для соответствующей ссылки (tab)
    document
      .querySelectorAll(".profile_nav_link")
      .forEach(function (link, index) {
        if (index === parseInt(activeTab)) {
          link.classList.add("profile_nav_link_active");

          tabs[index].style.display = "block";
        }
      });

    // Дополнительно, можно показать содержимое соответствующей вкладки
  } else {
    tabs[0].style.display = "block";
    tab_links[0].classList.add("profile_nav_link_active");
  }
});

document.getElementById("toggleMenu").addEventListener("click", function () {
  sideMenu.style.left = "0%";
});

document.getElementById("krest").addEventListener("click", function () {
  sideMenu.style.left = "-100%";
});

document.getElementById("mobile_login").addEventListener("click", function () {
  sideMenu.style.left = "0%";
});





document.getElementById("go_dictionary").addEventListener("click", function() {


  localStorage.setItem("activeTab", 2);

  tabs.forEach(function (tab) {
    tab.style.display = "none";
  });

  document.querySelectorAll(".profile_nav_link").forEach(function (link) {
    link.classList.remove("profile_nav_link_active");
  });
  document.querySelectorAll(".profile_nav_link")[2].classList.add("profile_nav_link_active"); 

  tabs[2].style.display = "block";


})
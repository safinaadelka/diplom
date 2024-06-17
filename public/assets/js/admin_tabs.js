profile_links = document.querySelectorAll(".profile_block");
tab_links = document.querySelectorAll(".profile_nav_link");

// При клике на ссылку (tab)
document.querySelectorAll(".profile_block").forEach(function (tabLink, index) {
  tabLink.addEventListener("click", function () {
    // Сохраняем индекс выбранной вкладки в local storage
    localStorage.setItem("activeTab", index + 1);
    // Устанавливаем активный класс для выбранной ссылки (tab)
    document.querySelectorAll(".profile_block").forEach(function (link) {
      // tab_links.classList.remove("profile_nav_link_active")
    });

    tabs.forEach(function (tab) {
      tab.style.display = "none";
    });
    tabs[index + 1].style.display = "block";

    document.querySelectorAll(".profile_nav_link").forEach(function (nav_link) {
      nav_link.classList.remove("profile_nav_link_active");
    });
    document
      .querySelectorAll(".profile_nav_link")
      [index + 1].classList.add("profile_nav_link_active");
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
  const profile = localStorage.getItem("profile_block");

  if (activeTab !== null) {
    // console.log("AT", activeTab);
    if (activeTab < 7) {
      console.log("AT < 7", activeTab);
      document
        .querySelectorAll(".profile_block")
        .forEach(function (link, index) {
          if (index === parseInt(activeTab)) {
            tabs.forEach(function (tab) {
              tab.style.display = "none";
            });

            tabs[index].style.display = "block";

            document
              .querySelectorAll(".profile_nav_link")
              [index].classList.add("profile_nav_link_active");
          }
        });
    } else {
      document
        .querySelectorAll(".profile_nav_link")
        .forEach(function (link, index) {
          if (index === parseInt(activeTab)) {
            console.log("AT > 7", activeTab);
            tabs.forEach(function (tab) {
              tab.style.display = "none";
            });

            tabs[index].style.display = "block";

            document
              .querySelectorAll(".profile_nav_link")
              .forEach(function (nav_link) {
                nav_link.classList.remove("profile_nav_link_active");
              });
            document
              .querySelectorAll(".profile_nav_link")
              [index].classList.add("profile_nav_link_active");

            // [index - 1].classList.add("profile_nav_link_active");
          }
        });
    }
    // Устанавливаем активный класс для соответствующей ссылки (tab)

    // Дополнительно, можно показать содержимое соответствующей вкладки
  } else {
    tabs[0].style.display = "block";
    document
      .querySelectorAll(".profile_nav_link")[0]
      .classList.add("profile_nav_link_active");
  }
});




document.getElementById("go_dictionary_admin").addEventListener("click", function() {

  console.log("fucking"); 
  
  
    localStorage.setItem("activeTab", 9);
  
    tabs.forEach(function (tab) {
      tab.style.display = "none";
    });
  
    document.querySelectorAll(".profile_nav_link").forEach(function (link) {
      link.classList.remove("profile_nav_link_active");
    });
    document.querySelectorAll(".profile_nav_link")[9].classList.add("profile_nav_link_active"); 
  
    tabs[9].style.display = "block";
  })






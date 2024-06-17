let inputs = document.querySelectorAll("input");
let error;
var pass1_error;
var pass2_error;
let animate1;
let animate2;
let errorElement1;
let errorElement2;
let array;

const password = document.querySelector("#password");
const togglePassword = document.querySelector("#togglePassword");
togglePassword.addEventListener("click", function () {
  const type =
    password.getAttribute("type") === "password" ? "text" : "password";
  password.setAttribute("type", type);
  this.classList.toggle("bi-eye");
});

const toggleRepeatPassword = document.querySelector("#toggleRepeatPassword");
const password_repeat = document.querySelector("#password_repeat");
if (toggleRepeatPassword) {
  toggleRepeatPassword.addEventListener("click", function () {
    const type =
      password_repeat.getAttribute("type") === "password" ? "text" : "password";
    password_repeat.setAttribute("type", type);
    this.classList.toggle("bi-eye");
  });
}


const toggleOldtPassword = document.querySelector("#toggleOldPassword");
const password_old = document.querySelector("#old_password");
if (toggleOldtPassword) {
  toggleOldtPassword.addEventListener("click", function () {
    const type =
    password_old.getAttribute("type") === "password" ? "text" : "password";
    password_old.setAttribute("type", type);
    this.classList.toggle("bi-eye");
  });
}

inputs.forEach((input) => {
  input.addEventListener("input", function () {
    error = EMPT(input.value);

    const animate = input.parentNode;
    const errorElement = animate.parentNode.querySelector(".error");
    // есть ошибка
    if (error) {
      FindError(errorElement, input);
    }

    // нет ошибки
    else {
      // проверка поля email
      if (input.id == "email") {
        error = Email(input.value);

        if (error) {
          FindError(errorElement, input);
        } else {
          errorElement.remove();
          input.classList.remove("input_error");
          validity = true;
        }
      }

      // проверка поля password
      else if (input.id == "password" || input.id == "password_repeat" || input.id == "old_password") {
        console.log("пароль нашли");
        error = Password(input.value);
        pass1_error = Password(document.querySelector("#password").value);



        if(input.id == "password_repeat"){
          console.log("repeat");
          pass2_error = Password(
            document.querySelector("#password_repeat").value
          );
          console.log("pass2_error", pass2_error); 
        }

  

        // есть ошибка - НЕ прошла валидация пароля 
        if (error) {
          FindError(errorElement, input);
          console.log("НЕпрошла валидация пароля"); 
        }
        
        
        else if (typeof pass2_error !== "undefined" && typeof pass1_error !== "undefined") {
          console.log("Undefined"); 

          // ошибки пусты
          if (!pass1_error && !pass2_error) {
            console.log("pass1 и pass2 ПУСТЫ"); 
            error = PasswordMatch(
              document.querySelector("#password").value,
              document.querySelector("#password_repeat").value
            );

            animate1 = document.querySelector("#password").parentNode;
            animate2 = document.querySelector("#password_repeat").parentNode;
            errorElement1 = animate1.parentNode.querySelector(".error");
            errorElement2 = animate2.parentNode.querySelector(".error");
            console.log("2", errorElement2); 


            // если пароли НЕ совпали
            if (error) {
              console.log("если пароли НЕ совпали"); 
              FindError(errorElement1, document.querySelector("#password"));
              FindError(
                errorElement2,
                document.querySelector("#password_repeat")
              );
            }
            // пароли СОВПАЛИ
            else {
              console.log("пароли СОВПАЛИ"); 
              if(errorElement1){
                errorElement1.remove();
              }
              if(errorElement2){
                errorElement2.remove();
              }
              document
                .querySelector("#password")
                .classList.remove("input_error");
              document
                .querySelector("#password_repeat")
                .classList.remove("input_error");
            }
          }
          
          
          // ошибки еще есть у каждого поля - свои уникальный
          else {
            errorElement.remove();
            input.classList.remove("input_error");
            console.log("УРААААААА"); 
          }
        }


        else {
          errorElement.remove();
          input.classList.remove("input_error");
          console.log("ошибки НЕТ"); 
        }
      }
      



      // нет ошибки и это любой другой элемент
      else {
        errorElement.remove();
        input.classList.remove("input_error");
      }
    }
  });
});

function EMPT(value) {
  if (!value.trim()) {
    return "поле не может быть пустым";
  } else {
    return "";
  }
}

function Email(value) {
  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!value.match(emailPattern)) {
    return "неверный формат почты";
  } else {
    return "";
  }
}

function Password(value) {
  const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?!.*\s).{8,}$/;
  if (!value.match(passwordPattern)) {
    return "Латиница, минимум 8 символов, 1 заглавная, 1 строчная буква, 1 цифра, без пробелов";
  } else {
    return "";
  }
}

function PasswordMatch(value1, value2) {
  if (value1 === value2) {
    return "";
  } else {
    return "пароли не совпадают";
  }
}
function FindError(errorElement, input) {
  validity = false;
  input.classList.add("input_error");
  if (!errorElement) {
    input.parentNode.insertAdjacentHTML(
      "afterend",
      '<p class="error red">' + error + "</p>"
    );
  } else if (errorElement) {
    errorElement.innerHTML = error;
  }
}

document.querySelectorAll("input").forEach((input) => {
  input.addEventListener("input", checkFormValidity);
});

function checkFormValidity() {
  let allInputsFilled = true;
  let errorCount = document.querySelectorAll(".error").length;
  console.log("error", errorCount);

  // Проверяем все поля на заполненность
  document.querySelectorAll("input").forEach((input) => {
    if (input.value.trim() === "") {
      allInputsFilled = false;
    }
    console.log(allInputsFilled);
  });

  // Если все поля заполнены и количество ошибок равно 0, снимаем атрибут disabled у кнопки
  if (allInputsFilled && errorCount === 0) {
    document.querySelector("#register_btn").removeAttribute("disabled");
  } else {
    document
      .querySelector("#register_btn")
      .setAttribute("disabled", "disabled");
  }
  
}

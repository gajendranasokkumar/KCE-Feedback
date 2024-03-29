document.getElementById('input_id').value = "";
document.getElementById('question_id1').value = "";

let addbtn = document.getElementById("add_btn_id");
addbtn.addEventListener("click", add_question_box);
let serial_num = 2;
idnum = 1;
function add_question_box() {
  let validate_input = document.getElementById(`question_id${idnum}`).value;
  console.log(validate_input);
  if (validate_input.length < 20) {
    alert("Please Enter above 20 characters");
    return 0;
  }

  if (serial_num <= 10) {
    serial_num = ("0" + serial_num).slice(-2);
  }
  let question_box = document.createElement("div");
  question_box.classList.add("question_box");
  let sno = document.createElement("div");
  sno.classList.add("no_of_sno");
  question_box.appendChild(sno);
  sno.innerHTML = serial_num;
  let question = document.createElement("div");
  question.classList.add("question");
  question_box.appendChild(question);
  let question_input = document.createElement("textarea");
  idnum++;
  question_input.id = `question_id${idnum}`;
  question_input.name = `question_id${idnum}`;
  question_input.classList.add("question_input");
  question_input.placeholder = "Question...";
  question.appendChild(question_input);
  document.getElementById("question_box-id").appendChild(question_box);
  serial_num++;
  // validate_input=null;
}

document
  .getElementById("questionForm")
  .addEventListener("submit", function (event) {
    event.preventDefault();
  });
document
  .getElementById("add_btn_id")
  .addEventListener("submit", function (event) {
    event.preventDefault();
  });

function clickFunction() {
  document.getElementById("questionForm").submit();
}

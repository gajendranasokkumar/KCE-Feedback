let table = document.getElementById("courses_info");
let handling_teachers = [
  {
    staff1_course_code: "21PC01",
    staff1_course_name: $table_data["sub1"],
    staff1_name: "Vikram",
  },
  {
    staff1_course_code: "21PC02",
    staff1_course_name: "ACP",
    staff1_name: "Aarthi",
  },
  {
    staff1_course_code: "21PC03",
    staff1_course_name: "TAMIL",
    staff1_name: "begum",
  },
  {
    staff1_course_code: "21PC04",
    staff1_course_name: "TE - I",
    staff1_name: "Pooja",
  },
  {
    staff1_course_code: "21PC05",
    staff1_course_name: "PHYCIS",
    staff1_name: "VijayaKumar",
  },
  {
    staff1_course_code: "21PC06",
    staff1_course_name: "Maths",
    staff1_name: "begum",
  },
];
for (let i = 0; i < 6; i++) {
  let row = table.insertRow(i + 1);
  let cell1 = row.insertCell(0);
  let cell2 = row.insertCell(1);
  let cell3 = row.insertCell(2);
  let cell4 = row.insertCell(3);
  cell1.innerHTML = i + 1 + ".";
  cell2.innerHTML = handling_teachers[i].staff1_course_code;
  cell3.innerHTML = handling_teachers[i].staff1_course_name;
  cell4.innerHTML = handling_teachers[i].staff1_name;
  cell1.style.textAlign = "center";
  cell2.style.textAlign = "center";
}

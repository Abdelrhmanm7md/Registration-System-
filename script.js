let det = document.getElementById("det");
let tt = document.getElementById("tt");
let reg = document.getElementById("reg");
let pay = document.getElementById("pay");

function changeSection(section) {
  switch (section) {
    case "det":
      det.classList.add("d-block");
      tt.classList.add("d-none");
      reg.classList.add("d-none");
      pay.classList.add("d-none");
      break;

    case "tt":
      det.classList.add("d-none");
      tt.classList.add("d-block");
      reg.classList.add("d-none");
      pay.classList.add("d-none");
      break;

    case "reg":
      det.classList.add("d-none");
      tt.classList.add("d-none");
      reg.classList.add("d-block");
      pay.classList.add("d-none");
      break;

    case "pay":
      det.classList.add("d-none");
      tt.classList.add("d-none");
      reg.classList.add("d-none");
      pay.classList.add("d-block");
      break;
  }
}

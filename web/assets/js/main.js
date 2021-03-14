//главная страница
const tableTravel = document.querySelector("#tableTravel");
if (tableTravel) {
  const departure = document.querySelector(".departure");
  const arrival = document.querySelector(".arrival");

  function sorts(name, event) {
    event.preventDefault();
    const sort = +event.target.dataset.sort;
    const res = [...document.querySelectorAll(".item")];
    if (sort) {
      res.sort((a, b) => b.querySelector(`[data-${name}]`).dataset[name] - a.querySelector(`[data-${name}]`).dataset[name]);
    } else {
      res.sort((a, b) => a.querySelector(`[data-${name}]`).dataset[name] - b.querySelector(`[data-${name}]`).dataset[name]);
    }

    tableTravel.innerHTML = res.map((item) => item.outerHTML).join("");
    event.target.dataset.sort = sort ? 0 : 1;
  }

  departure.addEventListener("click", sorts.bind(this, "departure"));
  arrival.addEventListener("click", sorts.bind(this, "arrival"));
}

// страница добавления
const form = document.querySelector("form");
const region = document.querySelector("#region");
const data = document.querySelector("#date-departure");
const arrival = document.querySelector("#date-arrival");
const errorResult = document.querySelector(".invalid");

if (form) {
  form.addEventListener("submit", async (event) => {
    event.preventDefault();
    const formData = new FormData(form);
    const validate = [...formData].map((v) => ({
      value: v[1],
      isValid: Boolean(v[1]),
      name: v[0],
    }));
    const isValid = validate.filter((k) => !k.isValid && k.name !== "date_arrival");
    if (isValid.length) {
      return isValid.forEach((n) => document.querySelector(`[name="${n.name}"]`).classList.add("is-invalid"));
    }
    const rep = validate.find((v) => v.name == "region");
    rep.value = region[region.selectedIndex].label;
    const result = await fetch("/create", {
      method: "POST",
      body: JSON.stringify(validate),
      headers: {
        "Content-Type": "application/json",
      },
    });
    const data = await result.json();
    if (data.error) {
      errorResult.innerHTML = `<div class="alert alert-danger" role="alert">${data.message}</div>`;
    } else if (data.success) {
      errorResult.innerHTML = `<div class="alert alert-success" role="alert">${data.message}</div>`;
    }
    return false;
  });

  form.addEventListener("change", (event) => {
    event.preventDefault();
    if (event.target.value) {
      event.target.classList.remove("is-invalid");
      event.target.classList.add("is-valid");
    } else {
      event.target.classList.remove("is-valid");
      event.target.classList.add("is-invalid");
    }

    if (region.value && data.value) {
      const res = 3600000 * 24 * region.value;
      arrival.value = new Date(Date.parse(data.value) + res).toLocaleDateString();
    } else {
      arrival.value = "";
    }
  });
}

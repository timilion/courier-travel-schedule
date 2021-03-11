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

(function () {
  "use strict";

  const mockResults = {
    Toyota: {
      make: "Toyota",
      model: "Corolla",
      body: "Sedan",
      engine: "4A-FE 1.6L",
      grade: "X",
      drive: "FWD",
      year: "1998",
      transmission: "Automatic",
      fuel: "Petrol",
    },
    Nissan: {
      make: "Nissan",
      model: "Skyline",
      body: "Coupe",
      engine: "RB25DE 2.5L",
      grade: "GT",
      drive: "RWD",
      year: "1999",
      transmission: "Manual",
      fuel: "Petrol",
    },
    Honda: {
      make: "Honda",
      model: "Civic",
      body: "Hatchback",
      engine: "D16A 1.6L",
      grade: "VTi",
      drive: "FWD",
      year: "1997",
      transmission: "Manual",
      fuel: "Petrol",
    },
    Mazda: {
      make: "Mazda",
      model: "Demio",
      body: "Hatchback",
      engine: "B3-ME 1.3L",
      grade: "DX",
      drive: "FWD",
      year: "2001",
      transmission: "Automatic",
      fuel: "Petrol",
    },
    Mitsubishi: {
      make: "Mitsubishi",
      model: "Lancer",
      body: "Sedan",
      engine: "4G93 1.8L",
      grade: "GSR",
      drive: "FWD",
      year: "2000",
      transmission: "Manual",
      fuel: "Petrol",
    },
    Subaru: {
      make: "Subaru",
      model: "Impreza",
      body: "Wagon",
      engine: "EJ20 2.0L",
      grade: "WRX",
      drive: "AWD",
      year: "2002",
      transmission: "Manual",
      fuel: "Petrol",
    },
    Suzuki: {
      make: "Suzuki",
      model: "Swift",
      body: "Hatchback",
      engine: "M13A 1.3L",
      grade: "RS",
      drive: "FWD",
      year: "2005",
      transmission: "Automatic",
      fuel: "Petrol",
    },
    Daihatsu: {
      make: "Daihatsu",
      model: "Move",
      body: "Mini vehicle",
      engine: "EF-VE 0.66L",
      grade: "L",
      drive: "FWD",
      year: "2003",
      transmission: "Automatic",
      fuel: "Petrol",
    },
    Isuzu: {
      make: "Isuzu",
      model: "Elf",
      body: "Truck",
      engine: "4HF1 4.3L",
      grade: "NPR",
      drive: "RWD",
      year: "2004",
      transmission: "Manual",
      fuel: "Diesel",
    },
    Lexus: {
      make: "Lexus",
      model: "IS",
      body: "Sedan",
      engine: "2JZ-GE 3.0L",
      grade: "300",
      drive: "RWD",
      year: "2001",
      transmission: "Automatic",
      fuel: "Petrol",
    },
  };

  const form = document.querySelector("[data-chassis-form]");
  const results = document.querySelector("[data-chassis-results]");

  if (!form || !results) return;

  form.addEventListener("submit", (event) => {
    event.preventDefault();

    const numberInput = form.querySelector("#chassis-number");
    const makerSelect = form.querySelector("#chassis-maker");

    if (!numberInput || !makerSelect) return;

    if (!form.checkValidity()) {
      form.reportValidity();
      return;
    }

    const maker = makerSelect.value;
    const data = mockResults[maker] || mockResults.Toyota;

    results.querySelectorAll("[data-chassis-field]").forEach((node) => {
      const key = node.getAttribute("data-chassis-field");
      node.textContent = data[key] || "—";
    });

    results.hidden = false;
    results.scrollIntoView({ behavior: "smooth", block: "nearest" });
  });
})();

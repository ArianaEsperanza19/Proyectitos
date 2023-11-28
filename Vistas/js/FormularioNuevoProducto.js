"use strict";
const nombre = document.getElementById("nombre");
nombre.addEventListener("input", function () {
  const validacion = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?¡¿~]/g;
  const p_n = document.getElementById("mensaje_nombre");

  if (nombre.value == "") {
    p_n.innerHTML = "• Rellena el campo";
  } else {
    if (validacion.test(nombre.value)) {
      p_n.className = "mensaje_validar";
      p_n.innerHTML = "• No se permiten caracteres especiales";
      const b = document.getElementById("submit");
      b.style.backgroundColor = "rgb(166, 166, 166)";
      b.style.color = "#6b6b6b";
      b.disabled = true;
    } else {
      p_n.innerHTML = "";
      const b = document.getElementById("submit");
      b.style.backgroundColor = "#1e1e1e";
      b.style.color = "white";
      document.getElementById("submit").disabled = false;
    }
  }
});

const precioDetal = document.getElementById("precioDetal");
precioDetal.addEventListener("input", function () {
  const validacion = /^[0-9]*\.?[0-9]+$/;
  const p_c = document.getElementById("mensaje_detal");
  if (!validacion.test(precioDetal.value)) {
    p_c.className = "mensaje_validar";
    p_c.innerHTML = "• Solo se permiten numeros positivos";
    const b = document.getElementById("submit");
    b.style.backgroundColor = "rgb(166, 166, 166)";
    b.style.color = "#6b6b6b";
    document.getElementById("submit").disabled = true;
    if (precioDetal.value == "") {
      p_c.innerHTML = "• Rellena bien el campo";
    }
  } else {
    p_c.innerHTML = "";
    const b = document.getElementById("submit");
    b.style.backgroundColor = "#1e1e1e";
    b.style.color = "white";
    document.getElementById("submit").disabled = false;
  }
});

const precioMayor = document.getElementById("costoMayor");
precioMayor.addEventListener("input", function () {
  const validacion = /^[0-9]*\.?[0-9]+$/;
  const p_c = document.getElementById("mensaje_mayor");
  if (!validacion.test(precioMayor.value)) {
    p_c.className = "mensaje_validar";
    p_c.innerHTML = "• Solo se permiten numeros positivos";
    const b = document.getElementById("submit");
    b.style.backgroundColor = "rgb(166, 166, 166)";
    b.style.color = "#6b6b6b";
    document.getElementById("submit").disabled = true;
    if (precioMayor.value == "") {
      p_c.innerHTML = "• Rellena bien el campo";
    }
  } else {
    p_c.innerHTML = "";
    const b = document.getElementById("submit");
    b.style.backgroundColor = "#1e1e1e";
    b.style.color = "white";
    document.getElementById("submit").disabled = false;
  }
});

const cantidad = document.getElementById("cantidad");
cantidad.addEventListener("input", function () {
  const validacion = /^[0-9]*\.?[0-9]+$/;
  const p_c = document.getElementById("mensaje_cantidad");
  if (!validacion.test(cantidad.value)) {
    p_c.className = "mensaje_validar";
    p_c.innerHTML = "• Solo se permiten numeros positivos";
    const b = document.getElementById("submit");
    b.style.backgroundColor = "rgb(166, 166, 166)";
    b.style.color = "#6b6b6b";
    document.getElementById("submit").disabled = true;
    if (cantidad.value == "") {
      p_c.innerHTML = "• Rellena bien el campo";
    }
  } else {
    p_c.innerHTML = "";
    const b = document.getElementById("submit");
    b.style.backgroundColor = "#1e1e1e";
    b.style.color = "white";
    document.getElementById("submit").disabled = false;
  }
})

const unidades = document.getElementById("unidades");
unidades.addEventListener("input", function () {
  const validacion = /^[0-9]*\.?[0-9]+$/;
  const p_u = document.getElementById("mensaje_unidades");
  if (!validacion.test(unidades.value)) {
    p_u.className = "mensaje_validar";
    p_u.innerHTML = "• Solo se permiten numeros positivos";
    const b = document.getElementById("submit");
    b.style.backgroundColor = "rgb(166, 166, 166)";
    b.style.color = "#6b6b6b";
    document.getElementById("submit").disabled = true;
    if (unidades.value == "") {
      p_u.innerHTML = "• Rellena bien el campo";
    }
  } else {
    p_u.innerHTML = "";
    const b = document.getElementById("submit");
    b.style.backgroundColor = "#1e1e1e";
    b.style.color = "white";
    document.getElementById("submit").disabled = false;
  }
})

"use strict";
//const form = document.getElementById("pedido");
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
      p_c.innerHTML = "• Rellena el campo";
    }
  } else {
    p_c.innerHTML = "";
    const b = document.getElementById("submit");
    b.style.backgroundColor = "#1e1e1e";
    b.style.color = "white";
    document.getElementById("submit").disabled = false;
  }
});

const fecha = document.getElementById("fecha");
fecha.addEventListener("input", function () {
  const p_f = document.getElementById("mensaje_fecha");
  const fechaminima = "1900-01-01";
  const fechamaxima = "2100-01-01";
  if (fecha.value >= fechamaxima || fecha.value <= fechaminima) {
    p_f.className = "mensaje_validar";
    p_f.innerHTML = "• Fecha fuera de rango";
    const b = document.getElementById("submit");
    b.style.backgroundColor = "rgb(166, 166, 166)";
    b.style.color = "#6b6b6b";
    document.getElementById("submit").disabled = true;
  } else {
    p_f.innerHTML = "";
    const b = document.getElementById("submit");
    b.style.backgroundColor = "#1e1e1e";
    b.style.color = "white";
    document.getElementById("submit").disabled = false;
  }
});

const quincena = document.getElementById("quincena");
quincena.addEventListener("input", function () {
  const p_q = document.getElementById("mensaje_quincena");
  const fechaminima = "1900-01-01";
  const fechamaxima = "2100-01-01";
  if (quincena.value >= fechamaxima || quincena.value <= fechaminima) {
    p_q.className = "mensaje_validar";
    p_q.innerHTML = "• Fecha fuera de rango";
    const b = document.getElementById("submit");
    b.style.backgroundColor = "rgb(166, 166, 166)";
    b.style.color = "#6b6b6b";
    document.getElementById("submit").disabled = true;
  } else {
    p_q.innerHTML = "";
    const b = document.getElementById("submit");
    b.style.backgroundColor = "#1e1e1e";
    b.style.color = "white";
    document.getElementById("submit").disabled = false;
  }
});

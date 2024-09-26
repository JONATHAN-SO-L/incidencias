function toggle(o) {
    var horas_habilitadas = document.querySelector(".horas_habilitadas");
    var goce_sueldo = document.querySelector(".goce_sueldo");

    // Se desactiva el DIV de SELECCIÓN DE HORAS según los MOTIVOS DE AUSENCIA
    if (o.value == "0") horas_habilitadas.style.display ="none";
    if (o.value == "Paternidad") horas_habilitadas.style.display ="none";
    if (o.value == "Personal: Trabajo desde casa") horas_habilitadas.style.display="none";
    if (o.value == "Personal: Falta Justificada") horas_habilitadas.style.display="none";
    if (o.value == "Personal: Falta Injustificada") horas_habilitadas.style.display="none";
    if (o.value == "Incapacidades: Enfermedad General") horas_habilitadas.style.display="none";
    if (o.value == "Incapacidades: Riesgo de trabajo") horas_habilitadas.style.display="none";
    if (o.value == "Incapacidades: Maternidad") horas_habilitadas.style.display="none";
    if (o.value == "Vacaciones") horas_habilitadas.style.display="none";

    if (o.value == "0") goce_sueldo.style.display ="none";
    if (o.value == "Retardo Justificado") goce_sueldo.style.display ="none";
    if (o.value == "Paternidad") goce_sueldo.style.display="none";
    if (o.value == "Personal: Trabajo desde casa") goce_sueldo.style.display="none";
    if (o.value == "Personal: Falta Injustificada") goce_sueldo.style.display="none";
    if (o.value == "Incapacidades: Enfermedad General") goce_sueldo.style.display="none";
    if (o.value == "Incapacidades: Riesgo de trabajo") goce_sueldo.style.display="none";
    if (o.value == "Incapacidades: Maternidad") goce_sueldo.style.display="none";
    if (o.value == "Vacaciones") goce_sueldo.style.display="none";
    if (o.value == "Labor de campo") goce_sueldo.style.display="none";

    //Se habilita el DIV de SELECCIÓN DE HORAS según los MOTIVOS DE AUSENCIA
    if (o.value == "Retardo Justificado") horas_habilitadas.style.display="block";
    if (o.value == "Retardo Injustificado") horas_habilitadas.style.display="block";
    if (o.value == "Personal: Tiempo por tiempo") horas_habilitadas.style.display="block";
    if (o.value == "Salud") horas_habilitadas.style.display="block";
    if (o.value == "Labor de campo") horas_habilitadas.style.display="block";

    if (o.value == "Retardo Injustificado") goce_sueldo.style.display="block";
    if (o.value == "Personal: Tiempo por tiempo") goce_sueldo.style.display="block";
    if (o.value == "Personal: Falta Justificada") goce_sueldo.style.display="block";
    if (o.value == "Salud") goce_sueldo.style.display="block";
}
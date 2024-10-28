/*********************************************************
Habilitación de campos según aplique el motivo de ausencia
*********************************************************/
function toggle(o) {
    // Variables para mostrar DIV's
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
    if (o.value == "Incapacidades: Interna") horas_habilitadas.style.display="none";

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
    if (o.value == "Incapacidades: Interna") goce_sueldo.style.display="none";

    // Se habilita el DIV de SELECCIÓN DE HORAS según los MOTIVOS DE AUSENCIA
    if (o.value == "Retardo Justificado") horas_habilitadas.style.display="block";
    if (o.value == "Retardo Injustificado") horas_habilitadas.style.display="block";
    if (o.value == "Personal: Tiempo por tiempo") horas_habilitadas.style.display="block";
    if (o.value == "Salud") horas_habilitadas.style.display="block";
    if (o.value == "Labor de campo") horas_habilitadas.style.display="block";

    if (o.value == "Retardo Injustificado") goce_sueldo.style.display="block";
    if (o.value == "Personal: Tiempo por tiempo") goce_sueldo.style.display="block";
    if (o.value == "Personal: Falta Justificada") goce_sueldo.style.display="block";
    if (o.value == "Salud") goce_sueldo.style.display="block";

    // Variables para mostrar imágenes de referencia
    var retardo_justificado = document.querySelector(".retardo_justificado");
    var retardo_injustificado = document.querySelector(".retardo_injustificado");
    var paternidad = document.querySelector(".paternidad");
    var tiempo_por_tiempo = document.querySelector(".tiempo_por_tiempo");
    var trabajo_casa = document.querySelector(".trabajo_casa");
    var falta_justificada = document.querySelector(".falta_justificada");
    var falta_injustificada = document.querySelector(".falta_injustificada");
    var salud = document.querySelector(".salud");
    var enfermedad_general = document.querySelector(".enfermedad_general");
    var riesgo_trabajo = document.querySelector(".riesgo_trabajo");
    var maternidad = document.querySelector(".maternidad");
    var vacaciones = document.querySelector(".vacaciones");
    var labor_campo = document.querySelector(".labor_campo");
    var incapacidad_interna = document.querySelector(".incapacidad_interna");

    // NO MOSTRAR imaégenes si no hay nada seleccionado
    if (o.value == "0") retardo_justificado.style.display="none";
    if (o.value == "0") retardo_injustificado.style.display="none";
    if (o.value == "0") paternidad.style.display="none";
    if (o.value == "0") tiempo_por_tiempo.style.display="none";
    if (o.value == "0") trabajo_casa.style.display="none";
    if (o.value == "0") falta_justificada.style.display="none";
    if (o.value == "0") falta_injustificada.style.display="none";
    if (o.value == "0") salud.style.display="none";
    if (o.value == "0") enfermedad_general.style.display="none";
    if (o.value == "0") riesgo_trabajo.style.display="none";
    if (o.value == "0") maternidad.style.display="none";
    if (o.value == "0") vacaciones.style.display="none";
    if (o.value == "0") labor_campo.style.display="none";
    if (o.value == "0") incapacidad_interna.style.display="none";

    // Mostrar imagen para RETARDO JUSTIFICADO
    if (o.value == "Retardo Justificado") retardo_justificado.style.display="block";
    if (o.value == "Retardo Justificado") retardo_injustificado.style.display="none";
    if (o.value == "Retardo Justificado") paternidad.style.display="none";
    if (o.value == "Retardo Justificado") tiempo_por_tiempo.style.display="none";
    if (o.value == "Retardo Justificado") trabajo_casa.style.display="none";
    if (o.value == "Retardo Justificado") falta_justificada.style.display="none";
    if (o.value == "Retardo Justificado") falta_injustificada.style.display="none";
    if (o.value == "Retardo Justificado") salud.style.display="none";
    if (o.value == "Retardo Justificado") enfermedad_general.style.display="none";
    if (o.value == "Retardo Justificado") riesgo_trabajo.style.display="none";
    if (o.value == "Retardo Justificado") maternidad.style.display="none";
    if (o.value == "Retardo Justificado") vacaciones.style.display="none";
    if (o.value == "Retardo Justificado") labor_campo.style.display="none";
    if (o.value == "Retardo Justificado") incapacidad_interna.style.display="none";

    // Mostrar imagen para RETARDO INJUSTIFICADO
    if (o.value == "Retardo Injustificado") retardo_justificado.style.display="none";
    if (o.value == "Retardo Injustificado") retardo_injustificado.style.display="block";
    if (o.value == "Retardo Injustificado") paternidad.style.display="none";
    if (o.value == "Retardo Injustificado") tiempo_por_tiempo.style.display="none";
    if (o.value == "Retardo Injustificado") trabajo_casa.style.display="none";
    if (o.value == "Retardo Injustificado") falta_justificada.style.display="none";
    if (o.value == "Retardo Injustificado") falta_injustificada.style.display="none";
    if (o.value == "Retardo Injustificado") salud.style.display="none";
    if (o.value == "Retardo Injustificado") enfermedad_general.style.display="none";
    if (o.value == "Retardo Injustificado") riesgo_trabajo.style.display="none";
    if (o.value == "Retardo Injustificado") maternidad.style.display="none";
    if (o.value == "Retardo Injustificado") vacaciones.style.display="none";
    if (o.value == "Retardo Injustificado") labor_campo.style.display="none";
    if (o.value == "Retardo Injustificado") incapacidad_interna.style.display="none";

    // Mostrar imagen para PATERNIDAD
    if (o.value == "Paternidad") retardo_justificado.style.display="none";
    if (o.value == "Paternidad") retardo_injustificado.style.display="none";
    if (o.value == "Paternidad") paternidad.style.display="block";
    if (o.value == "Paternidad") tiempo_por_tiempo.style.display="none";
    if (o.value == "Paternidad") trabajo_casa.style.display="none";
    if (o.value == "Paternidad") falta_justificada.style.display="none";
    if (o.value == "Paternidad") falta_injustificada.style.display="none";
    if (o.value == "Paternidad") salud.style.display="none";
    if (o.value == "Paternidad") enfermedad_general.style.display="none";
    if (o.value == "Paternidad") riesgo_trabajo.style.display="none";
    if (o.value == "Paternidad") maternidad.style.display="none";
    if (o.value == "Paternidad") vacaciones.style.display="none";
    if (o.value == "Paternidad") labor_campo.style.display="none";
    if (o.value == "Paternidad") incapacidad_interna.style.display="none";

    // Mostrar imagen para TIEMPO POR TIEMPO
    if (o.value == "Personal: Tiempo por tiempo") retardo_justificado.style.display="none";
    if (o.value == "Personal: Tiempo por tiempo") retardo_injustificado.style.display="none";
    if (o.value == "Personal: Tiempo por tiempo") paternidad.style.display="none";
    if (o.value == "Personal: Tiempo por tiempo") tiempo_por_tiempo.style.display="block";
    if (o.value == "Personal: Tiempo por tiempo") trabajo_casa.style.display="none";
    if (o.value == "Personal: Tiempo por tiempo") falta_justificada.style.display="none";
    if (o.value == "Personal: Tiempo por tiempo") falta_injustificada.style.display="none";
    if (o.value == "Personal: Tiempo por tiempo") salud.style.display="none";
    if (o.value == "Personal: Tiempo por tiempo") enfermedad_general.style.display="none";
    if (o.value == "Personal: Tiempo por tiempo") riesgo_trabajo.style.display="none";
    if (o.value == "Personal: Tiempo por tiempo") maternidad.style.display="none";
    if (o.value == "Personal: Tiempo por tiempo") vacaciones.style.display="none";
    if (o.value == "Personal: Tiempo por tiempo") labor_campo.style.display="none";
    if (o.value == "Personal: Tiempo por tiempo") incapacidad_interna.style.display="none";

    // Mostrar imagen para TRABAJO DESDE CASA
    if (o.value == "Personal: Trabajo desde casa") retardo_justificado.style.display="none";
    if (o.value == "Personal: Trabajo desde casa") retardo_injustificado.style.display="none";
    if (o.value == "Personal: Trabajo desde casa") paternidad.style.display="none";
    if (o.value == "Personal: Trabajo desde casa") tiempo_por_tiempo.style.display="none";
    if (o.value == "Personal: Trabajo desde casa") trabajo_casa.style.display="block";
    if (o.value == "Personal: Trabajo desde casa") falta_justificada.style.display="none";
    if (o.value == "Personal: Trabajo desde casa") falta_injustificada.style.display="none";
    if (o.value == "Personal: Trabajo desde casa") salud.style.display="none";
    if (o.value == "Personal: Trabajo desde casa") enfermedad_general.style.display="none";
    if (o.value == "Personal: Trabajo desde casa") riesgo_trabajo.style.display="none";
    if (o.value == "Personal: Trabajo desde casa") maternidad.style.display="none";
    if (o.value == "Personal: Trabajo desde casa") vacaciones.style.display="none";
    if (o.value == "Personal: Trabajo desde casa") labor_campo.style.display="none";
    if (o.value == "Personal: Trabajo desde casa") incapacidad_interna.style.display="none";

    // Mostrar imagen para FALTA JUSTIFICADA
    if (o.value == "Personal: Falta Justificada") retardo_justificado.style.display="none";
    if (o.value == "Personal: Falta Justificada") retardo_injustificado.style.display="none";
    if (o.value == "Personal: Falta Justificada") paternidad.style.display="none";
    if (o.value == "Personal: Falta Justificada") tiempo_por_tiempo.style.display="none";
    if (o.value == "Personal: Falta Justificada") trabajo_casa.style.display="none";
    if (o.value == "Personal: Falta Justificada") falta_justificada.style.display="block";
    if (o.value == "Personal: Falta Justificada") falta_injustificada.style.display="none";
    if (o.value == "Personal: Falta Justificada") salud.style.display="none";
    if (o.value == "Personal: Falta Justificada") enfermedad_general.style.display="none";
    if (o.value == "Personal: Falta Justificada") riesgo_trabajo.style.display="none";
    if (o.value == "Personal: Falta Justificada") maternidad.style.display="none";
    if (o.value == "Personal: Falta Justificada") vacaciones.style.display="none";
    if (o.value == "Personal: Falta Justificada") labor_campo.style.display="none";
    if (o.value == "Personal: Falta Justificada") incapacidad_interna.style.display="none";

    // Mostrar imagen para FALTA INJUSTIFICADA
    if (o.value == "Personal: Falta Injustificada") retardo_justificado.style.display="none";
    if (o.value == "Personal: Falta Injustificada") retardo_injustificado.style.display="none";
    if (o.value == "Personal: Falta Injustificada") paternidad.style.display="none";
    if (o.value == "Personal: Falta Injustificada") tiempo_por_tiempo.style.display="none";
    if (o.value == "Personal: Falta Injustificada") trabajo_casa.style.display="none";
    if (o.value == "Personal: Falta Injustificada") falta_justificada.style.display="none";
    if (o.value == "Personal: Falta Injustificada") falta_injustificada.style.display="block";
    if (o.value == "Personal: Falta Injustificada") salud.style.display="none";
    if (o.value == "Personal: Falta Injustificada") enfermedad_general.style.display="none";
    if (o.value == "Personal: Falta Injustificada") riesgo_trabajo.style.display="none";
    if (o.value == "Personal: Falta Injustificada") maternidad.style.display="none";
    if (o.value == "Personal: Falta Injustificada") vacaciones.style.display="none";
    if (o.value == "Personal: Falta Injustificada") labor_campo.style.display="none";
    if (o.value == "Personal: Falta Injustificada") incapacidad_interna.style.display="none";

    // Mostrar imagen para SALUD
    if (o.value == "Salud") retardo_justificado.style.display="none";
    if (o.value == "Salud") retardo_injustificado.style.display="none";
    if (o.value == "Salud") paternidad.style.display="none";
    if (o.value == "Salud") tiempo_por_tiempo.style.display="none";
    if (o.value == "Salud") trabajo_casa.style.display="none";
    if (o.value == "Salud") falta_justificada.style.display="none";
    if (o.value == "Salud") falta_injustificada.style.display="none";
    if (o.value == "Salud") salud.style.display="block";
    if (o.value == "Salud") enfermedad_general.style.display="none";
    if (o.value == "Salud") riesgo_trabajo.style.display="none";
    if (o.value == "Salud") maternidad.style.display="none";
    if (o.value == "Salud") vacaciones.style.display="none";
    if (o.value == "Salud") labor_campo.style.display="none";
    if (o.value == "Salud") incapacidad_interna.style.display="none";

    // Mostrar imagen para ENFERMEDAD GENERAL
    if (o.value == "Incapacidades: Enfermedad General") retardo_justificado.style.display="none";
    if (o.value == "Incapacidades: Enfermedad General") retardo_injustificado.style.display="none";
    if (o.value == "Incapacidades: Enfermedad General") paternidad.style.display="none";
    if (o.value == "Incapacidades: Enfermedad General") tiempo_por_tiempo.style.display="none";
    if (o.value == "Incapacidades: Enfermedad General") trabajo_casa.style.display="none";
    if (o.value == "Incapacidades: Enfermedad General") falta_justificada.style.display="none";
    if (o.value == "Incapacidades: Enfermedad General") falta_injustificada.style.display="none";
    if (o.value == "Incapacidades: Enfermedad General") salud.style.display="none";
    if (o.value == "Incapacidades: Enfermedad General") enfermedad_general.style.display="block";
    if (o.value == "Incapacidades: Enfermedad General") riesgo_trabajo.style.display="none";
    if (o.value == "Incapacidades: Enfermedad General") maternidad.style.display="none";
    if (o.value == "Incapacidades: Enfermedad General") vacaciones.style.display="none";
    if (o.value == "Incapacidades: Enfermedad General") labor_campo.style.display="none";
    if (o.value == "Incapacidades: Enfermedad General") incapacidad_interna.style.display="none";

    // Mostrar imagen para RIESGO DE TRABAJO
    if (o.value == "Incapacidades: Riesgo de trabajo") retardo_justificado.style.display="none";
    if (o.value == "Incapacidades: Riesgo de trabajo") retardo_injustificado.style.display="none";
    if (o.value == "Incapacidades: Riesgo de trabajo") paternidad.style.display="none";
    if (o.value == "Incapacidades: Riesgo de trabajo") tiempo_por_tiempo.style.display="none";
    if (o.value == "Incapacidades: Riesgo de trabajo") trabajo_casa.style.display="none";
    if (o.value == "Incapacidades: Riesgo de trabajo") falta_justificada.style.display="none";
    if (o.value == "Incapacidades: Riesgo de trabajo") falta_injustificada.style.display="none";
    if (o.value == "Incapacidades: Riesgo de trabajo") salud.style.display="none";
    if (o.value == "Incapacidades: Riesgo de trabajo") enfermedad_general.style.display="none";
    if (o.value == "Incapacidades: Riesgo de trabajo") riesgo_trabajo.style.display="block";
    if (o.value == "Incapacidades: Riesgo de trabajo") maternidad.style.display="none";
    if (o.value == "Incapacidades: Riesgo de trabajo") vacaciones.style.display="none";
    if (o.value == "Incapacidades: Riesgo de trabajo") labor_campo.style.display="none";
    if (o.value == "Incapacidades: Riesgo de trabajo") incapacidad_interna.style.display="none";

    // Mostrar imagen para MATERNIDAD
    if (o.value == "Incapacidades: Maternidad") retardo_justificado.style.display="none";
    if (o.value == "Incapacidades: Maternidad") retardo_injustificado.style.display="none";
    if (o.value == "Incapacidades: Maternidad") paternidad.style.display="none";
    if (o.value == "Incapacidades: Maternidad") tiempo_por_tiempo.style.display="none";
    if (o.value == "Incapacidades: Maternidad") trabajo_casa.style.display="none";
    if (o.value == "Incapacidades: Maternidad") falta_justificada.style.display="none";
    if (o.value == "Incapacidades: Maternidad") falta_injustificada.style.display="none";
    if (o.value == "Incapacidades: Maternidad") salud.style.display="none";
    if (o.value == "Incapacidades: Maternidad") enfermedad_general.style.display="none";
    if (o.value == "Incapacidades: Maternidad") riesgo_trabajo.style.display="none";
    if (o.value == "Incapacidades: Maternidad") maternidad.style.display="block";
    if (o.value == "Incapacidades: Maternidad") vacaciones.style.display="none";
    if (o.value == "Incapacidades: Maternidad") labor_campo.style.display="none";
    if (o.value == "Incapacidades: Maternidad") incapacidad_interna.style.display="none";

    // Mostrar imagen para VACACIONES
    if (o.value == "Vacaciones") retardo_justificado.style.display="none";
    if (o.value == "Vacaciones") retardo_injustificado.style.display="none";
    if (o.value == "Vacaciones") paternidad.style.display="none";
    if (o.value == "Vacaciones") tiempo_por_tiempo.style.display="none";
    if (o.value == "Vacaciones") trabajo_casa.style.display="none";
    if (o.value == "Vacaciones") falta_justificada.style.display="none";
    if (o.value == "Vacaciones") falta_injustificada.style.display="none";
    if (o.value == "Vacaciones") salud.style.display="none";
    if (o.value == "Vacaciones") enfermedad_general.style.display="none";
    if (o.value == "Vacaciones") riesgo_trabajo.style.display="none";
    if (o.value == "Vacaciones") maternidad.style.display="none";
    if (o.value == "Vacaciones") vacaciones.style.display="block";
    if (o.value == "Vacaciones") labor_campo.style.display="none";
    if (o.value == "Vacaciones") incapacidad_interna.style.display="none";

    // Mostrar imagen para LABOR DE CAMPO
    if (o.value == "Labor de campo") retardo_justificado.style.display="none";
    if (o.value == "Labor de campo") retardo_injustificado.style.display="none";
    if (o.value == "Labor de campo") paternidad.style.display="none";
    if (o.value == "Labor de campo") tiempo_por_tiempo.style.display="none";
    if (o.value == "Labor de campo") trabajo_casa.style.display="none";
    if (o.value == "Labor de campo") falta_justificada.style.display="none";
    if (o.value == "Labor de campo") falta_injustificada.style.display="none";
    if (o.value == "Labor de campo") salud.style.display="none";
    if (o.value == "Labor de campo") enfermedad_general.style.display="none";
    if (o.value == "Labor de campo") riesgo_trabajo.style.display="none";
    if (o.value == "Labor de campo") maternidad.style.display="none";
    if (o.value == "Labor de campo") vacaciones.style.display="none";
    if (o.value == "Labor de campo") labor_campo.style.display="block";
    if (o.value == "Labor de campo") incapacidad_interna.style.display="none";

    // Mostrar imagen para INCAPACIDAD INTERNA
    if (o.value == "Incapacidades: Interna") retardo_justificado.style.display="none";
    if (o.value == "Incapacidades: Interna") retardo_injustificado.style.display="none";
    if (o.value == "Incapacidades: Interna") paternidad.style.display="none";
    if (o.value == "Incapacidades: Interna") tiempo_por_tiempo.style.display="none";
    if (o.value == "Incapacidades: Interna") trabajo_casa.style.display="none";
    if (o.value == "Incapacidades: Interna") falta_justificada.style.display="none";
    if (o.value == "Incapacidades: Interna") falta_injustificada.style.display="none";
    if (o.value == "Incapacidades: Interna") salud.style.display="none";
    if (o.value == "Incapacidades: Interna") enfermedad_general.style.display="none";
    if (o.value == "Incapacidades: Interna") riesgo_trabajo.style.display="none";
    if (o.value == "Incapacidades: Interna") maternidad.style.display="none";
    if (o.value == "Incapacidades: Interna") vacaciones.style.display="none";
    if (o.value == "Incapacidades: Interna") labor_campo.style.display="none";
    if (o.value == "Incapacidades: Interna") incapacidad_interna.style.display="block";

}
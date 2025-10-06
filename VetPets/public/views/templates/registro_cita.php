<?php
require '../../../config/config.php';
?>
<div class="flex-grow">

    <form id="form-cita" class="space-y-4">
        <div class="flex min-w-72 flex-col gap-2">
            <h1 class="text-2xl font-bold">Registrar Nueva Cita</h1>
        </div>

        <!-- Fecha y Hora en la misma fila -->
        <div class="grid grid-cols-2 gap-4">
            <!-- Fecha de la cita -->
            <div>
                <label for="fecha_cita_nc" class="block text-sm font-medium text-gray-700">Fecha de la cita</label>
                <input type="date" id="fecha_cita_nc" name="fecha_cita_nc"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary sm:text-sm">
            </div>

            <!-- Hora de la cita -->
            <div>
                <label for="hora_cita_nc" class="block text-sm font-medium text-gray-700">Hora de la cita</label>
                <input type="time" id="hora_cita_nc" name="hora_cita_nc"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary sm:text-sm">
            </div>
        </div>


        <!-- Motivo -->
        <div>
            <label for="motivo_nc" class="block text-sm font-medium text-gray-700">Motivo</label>
            <textarea id="motivo_nc" name="motivo_nc" rows="2"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary sm:text-sm"></textarea>
        </div>

        <!-- Estado -->
        <div>
            <label for="estado" class="block text-sm font-medium text-gray-700">Estado</label>
            <select id="estado_nc" name="estado_nc"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary sm:text-sm">
                <option value="">Seleccione estado</option>
                <option value="pendiente">Pendiente</option>
                <option value="confirmada">Confirmada</option>
                <option value="cancelada">Cancelada</option>
                <option value="realizada">Realizada</option>
            </select>
        </div>

        <!-- Mascota -->
        <div class="flex flex-col gap-4">
            <label class="flex flex-col w-full">
                <p class="text-gray-700 dark:text-gray-300 text-base font-medium pb-2">Mascota*</p>
                <select id="id_mascota_nc" name="id_mascota_nc" required
                    class="form-select rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 h-12 px-4 text-base focus:ring-2 focus:ring-primary/50">
                    <option value="">Seleccione una mascota</option>
                    <?php
                    $query = $pdo_con->query("SELECT id_mascota, nombre FROM mascota ORDER BY nombre ASC");
                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='{$row['id_mascota']}'>{$row['nombre']}</option>";
                    }
                    ?>
                </select>
            </label>
        </div>

        <!-- Dueño -->
        <div class="flex flex-col gap-4">
            <label class="flex flex-col w-full">
                <p class="text-gray-700 dark:text-gray-300 text-base font-medium pb-2">Dueño*</p>
                <select id="id_dueno_nc" name="id_dueno_nc" required
                    class="form-select rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 h-12 px-4 text-base focus:ring-2 focus:ring-primary/50">
                    <option value="">Seleccione un dueño</option>
                    <?php
                    $query = $pdo_con->query("SELECT id_dueno, nombre FROM dueno ORDER BY nombre ASC");
                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='{$row['id_dueno']}'>{$row['nombre']}</option>";
                    }
                    ?>
                </select>
            </label>
        </div>

        <!-- Usuario (Veterinario) -->
        <div class="flex flex-col gap-4">
            <label class="flex flex-col w-full">
                <p class="text-gray-700 dark:text-gray-300 text-base font-medium pb-2">Usuario (Veterinario)*</p>
                <select id="id_usuario_nc" name="id_usuario_nc" required
                    class="form-select rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 h-12 px-4 text-base focus:ring-2 focus:ring-primary/50">
                    <option value="">Seleccione un usuario</option>
                    <?php
                    $query = $pdo_con->query("SELECT id_usuario, usuario FROM usuario ORDER BY usuario ASC");
                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='{$row['id_usuario']}'>{$row['usuario']}</option>";
                    }
                    ?>
                </select>
            </label>
        </div>

        <!-- Sede -->
        <div class="flex flex-col gap-4">
            <label class="flex flex-col w-full">
                <p class="text-gray-700 dark:text-gray-300 text-base font-medium pb-2">Sede*</p>
                <select id="id_sede_nc" name="id_sede_nc" required
                    class="form-select rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 h-12 px-4 text-base focus:ring-2 focus:ring-primary/50">
                    <option value="">Seleccione una sede</option>
                    <?php

                    $query = $pdo_con->query("SELECT id_sede, nombre_sede FROM sede ORDER BY nombre_sede ASC");
                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='{$row['id_sede']}'>{$row['nombre_sede']}</option>";
                    }
                    ?>
                </select>
            </label>
        </div>


        <!-- Botones -->
        <div class="flex flex-col md:flex-row justify-end gap-4 pt-4">
            <a href="#" data-page="templates/gestion_citas.php"
                class="px-6 h-12 flex items-center justify-center rounded-lg bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white font-bold hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                Cancelar
            </a>
            <button type="submit"
                class="px-6 h-12 flex items-center justify-center rounded-lg bg-primary text-white font-bold hover:bg-primary/90 transition">
                <span class="material-symbols-outlined mr-2">save</span>
                Guardar Cita
            </button>
        </div>
    </form>
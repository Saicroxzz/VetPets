<?php
require '../../../config/config.php';
?>
<div class="flex-grow">
    <div class="flex min-w-72 flex-col gap-2">
        <h1 class="text-2xl font-bold">Registrar Nueva Mascota</h1>
    </div>

    <form id="form-mascota" class="flex flex-col gap-2 pt-2">
        <!-- Nombre -->
        <div class="flex flex-col gap-4">
            <label class="flex flex-col w-full">
                <p class="text-gray-700 dark:text-gray-300 text-base font-medium pb-2">Nombre*</p>
                <input id="nombre" name="nombre" required
                    class="form-input rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 h-12 px-4 text-base focus:ring-2 focus:ring-primary/50"
                    placeholder="Ej. Firulais" />
            </label>
        </div>

        <!-- Especie -->
        <div class="flex flex-col gap-4">
            <label class="flex flex-col w-full">
                <p class="text-gray-700 dark:text-gray-300 text-base font-medium pb-2">Especie*</p>
                <select id="especie" name="especie" required
                    class="form-select rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 h-12 px-4 text-base focus:ring-2 focus:ring-primary/50">
                    <option value="">Seleccione</option>
                    <option value="Perro">Perro</option>
                    <option value="Gato">Gato</option>
                    <option value="Ave">Ave</option>
                    <option value="Otro">Otro</option>
                </select>
            </label>
        </div>

        <!-- Raza -->
        <div class="flex flex-col gap-4">
            <label class="flex flex-col w-full">
                <p class="text-gray-700 dark:text-gray-300 text-base font-medium pb-2">Raza*</p>
                <input id="raza" name="raza" required
                    class="form-input rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 h-12 px-4 text-base focus:ring-2 focus:ring-primary/50"
                    placeholder="Ej. Labrador" />
            </label>
        </div>

        <!-- Edad y Sexo en la misma fila -->
        <div class="flex flex-col md:flex-row gap-4">
            <!-- Edad -->
            <label class="flex flex-col w-full md:w-1/2">
                <p class="text-gray-700 dark:text-gray-300 text-base font-medium pb-2">Edad*</p>
                <input id="edad" name="edad" type="number" min="0" required
                    class="form-input rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 h-12 px-4 text-base focus:ring-2 focus:ring-primary/50"
                    placeholder="Ej. 3" />
            </label>

            <!-- Sexo -->
            <label class="flex flex-col w-full md:w-1/2">
                <p class="text-gray-700 dark:text-gray-300 text-base font-medium pb-2">Sexo*</p>
                <select id="sexo" name="sexo" required
                    class="form-select rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 h-12 px-4 text-base focus:ring-2 focus:ring-primary/50">
                    <option value="">Seleccione</option>
                    <option value="Macho">Macho</option>
                    <option value="Hembra">Hembra</option>
                </select>
            </label>
        </div>


        <!-- Select Dueño -->
        <div class="flex flex-col gap-4">
            <label class="flex flex-col w-full">
                <p class="text-gray-700 dark:text-gray-300 text-base font-medium pb-2">Dueño*</p>
                <select id="id_dueno" name="id_dueno" required
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

        <!-- Select Sede -->
        <div class="flex flex-col gap-4">
            <label class="flex flex-col w-full">
                <p class="text-gray-700 dark:text-gray-300 text-base font-medium pb-2">Sede*</p>
                <select id="id_sede" name="id_sede" required
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
            <a href="#" data-page="templates/gestion_mascotas.php"
                class="px-6 h-12 flex items-center justify-center rounded-lg bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white font-bold hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                Cancelar
            </a>
            <button type="submit"
                class="px-6 h-12 flex items-center justify-center rounded-lg bg-primary text-white font-bold hover:bg-primary/90 transition">
                <span class="material-symbols-outlined mr-2">save</span>
                Guardar Mascota
            </button>
        </div>
    </form>
</div>
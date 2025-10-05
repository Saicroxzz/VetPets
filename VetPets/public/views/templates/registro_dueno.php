<div class="flex-grow">
  <div class="flex min-w-72 flex-col gap-2">
        <h1 class="text-2xl font-bold">
            Registrar Nuevo Dueño</h1>
        </div>

  <div class="flex flex-col gap-6 pt-2">
    <div class="flex flex-col gap-4">
      <label class="flex flex-col w-full">
        <p class="text-gray-700 dark:text-gray-300 text-base font-medium pb-2">Nombre Completo*</p>
        <input class="form-input rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 h-12 px-4 text-base focus:ring-2 focus:ring-primary/50"
               placeholder="Ej. Juan Pérez" />
      </label>
    </div>

    <div class="flex flex-col gap-4">
      <label class="flex flex-col w-full">
        <p class="text-gray-700 dark:text-gray-300 text-base font-medium pb-2">Correo Electrónico*</p>
        <input type="email" class="form-input rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 h-12 px-4 text-base focus:ring-2 focus:ring-primary/50"
               placeholder="ejemplo@correo.com" />
      </label>
    </div>

    <div class="flex flex-col gap-4">
      <label class="flex flex-col w-full">
        <p class="text-gray-700 dark:text-gray-300 text-base font-medium pb-2">Número de Teléfono*</p>
        <input type="tel" class="form-input rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 h-12 px-4 text-base focus:ring-2 focus:ring-primary/50"
               placeholder="+57 321 456 7890" />
      </label>
    </div>

    <div class="flex flex-col gap-4">
      <label class="flex flex-col w-full">
        <p class="text-gray-700 dark:text-gray-300 text-base font-medium pb-2">Dirección*</p>
        <textarea class="form-input rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 min-h-28 p-4 text-base focus:ring-2 focus:ring-primary/50"
                  placeholder="Calle Falsa 123, Springfield"></textarea>
      </label>
    </div>
  </div>

  <div class="flex flex-col md:flex-row justify-end gap-4 pt-4">
    <a href="#" data-page="duenos.html"
       class="px-6 h-12 flex items-center justify-center rounded-lg bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white font-bold hover:bg-gray-300 dark:hover:bg-gray-600 transition">
      Cancelar
    </a>
    <button class="px-6 h-12 flex items-center justify-center rounded-lg bg-primary text-white font-bold hover:bg-primary/90 transition">
      <span class="material-symbols-outlined mr-2">save</span>
      Guardar Dueño
    </button>
  </div>
</div>

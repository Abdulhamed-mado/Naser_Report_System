@can('seeAccessplayers')

    <div class="container mx-auto py-16 px-8 gap-4" x-data="{ showModal: false, showEditModal: false, name: '', email: '', director_id: '', head_id: '', degree: '', role: '', int_date: '', end_date: '', password: '' }">
        <div class="container" x-data="{ showMessage: {{ session()->has('message') ? 'true' : 'false' }} }">
            @if (session()->has('message'))
                <div x-show="showMessage" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform -translate-y-2"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform -translate-y-2"
                    class="bg-emerald-500 text-white py-3 px-4 mb-4">
                    {{ session('message') }}
                </div>
            @endif
        </div>


        @if (session()->has('error'))
            <div class="bg-red-500 text-black py-3 px-4 mb-4">
                {{ session('error') }}
            </div>
        @endif




        <div class="ml-2">

            {{-- <input type="text" wire:model.lazy="search" placeholder="Search for user" class="ml-2 border border-opacity-50 border-width-2 rounded-md p-2 "> --}}


            @can('fullAccessplayers')
                <button
                    class="bg-black text-white ml-2 px-4 py-2 text-sm rounded-lg hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-800 focus:ring-opacity-50"
                    x-on:click="name = '';email = '';end_date = '';password = ''; int_date = '';showModal = true"
                    x-transition:enter="transition ease-out duration-300 transform"
                    x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-300 transform"
                    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
                    wire:click="lodemodel">
                    اضافة مستخدم
                </button>
            @endcan



            @if ($loaded)
                {{-- here start the add model --}}

                <div class="fixed z-10 inset-0 overflow-y-auto" x-show="showModal"
                    x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

                    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        <div class="fixed inset-0 transition-opacity" aria-hidden="true" x-show="showModal"
                            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-300"
                            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                        </div>

                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                            x-show="showModal" x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                            x-transition:leave="transition ease-in duration-300"
                            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 ">
                                <div class="sm:flex sm:items-start">
                                    <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                                        <h3 class="text-lg leading-6 font-medium text-gray-900 text-right">
                                            اضافة الاعب
                                        </h3>

                                        <div class="mt-2 text-right">
                                            <form>
                                                <div class="mb-4">
                                                    <label class="block text-gray-700 font-bold mb-2" for="pCardId">
                                                        رقم بطاقة العضوية
                                                    </label>
                                                    <input
                                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                        id="pCardId" type="text" placeholder="رقم بطاقة العضوية"
                                                        wire:model="pCardId">
                                                    @error('name')
                                                        <span
                                                            class="text-red-500">{{ 'الرجاء التأكد من رقم بطاقة العضوية' }}</span>
                                                    @enderror

                                                </div>
                                                <div class="mb-4">
                                                    <label class="block text-gray-700 font-bold mb-2" for="name">
                                                        اســــم
                                                    </label>
                                                    <input
                                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                        id="name" type="text" placeholder="اســــم"
                                                        wire:model="name">
                                                    @error('pCardId')
                                                        <span class="text-red-500">{{ 'الرجاء التأكد من اســــم' }}</span>
                                                    @enderror

                                                </div>

                                                <div class="mb-4">
                                                    <label class="block text-gray-700 font-bold mb-2" for="nationalNum">
                                                        رقم الوطني
                                                    </label>
                                                    <input
                                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                        id="nationalNum" type="text" placeholder=" رقم الوطني"
                                                        wire:model="nationalNum">
                                                    @error('nationalNum')
                                                        <span class="text-red-500">{{ 'الرجاء التأكد من رقم الوطني' }}</span>
                                                    @enderror

                                                </div>

                                                <div class="mb-4">
                                                    <label class="block text-gray-700 font-bold mb-2" for="birthDate">
                                                        تاريخ الميلاد
                                                    </label>
                                                    <input
                                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight text-right focus:outline-none focus:shadow-outline"
                                                        id="birthDate" type="date" wire:model="birthDate">
                                                    @error('birthDate')
                                                        <span class="text-red-500">{{ 'الرجاء التأكد من تاريخ الميلاد' }}</span>
                                                    @enderror

                                                </div>

                                                <div class="mb-4">
                                                    <label class="block text-gray-700 font-bold mb-2" for="height">
                                                        الطول
                                                    </label>
                                                    <input
                                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                        id="height" type="text" placeholder="الطول"
                                                        wire:model="height">
                                                    @error('height')
                                                        <span class="text-red-500">{{ 'الرجاء التأكد من الطول' }}</span>
                                                    @enderror

                                                </div>


                                                <div class="mb-4">
                                                    <label class="block text-gray-700 font-bold mb-2" for="weight">
                                                        الوزن
                                                    </label>
                                                    <input
                                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                        id="weight" type="text" placeholder="الوزن"
                                                        wire:model="weight">
                                                    @error('weight')
                                                        <span class="text-red-500">{{ 'الرجاء التأكد من الطول' }}</span>
                                                    @enderror

                                                </div>

                                                <div class="mb-4">
                                                    <label class="block text-gray-700 font-bold mb-2" for="speed">
                                                        السرعة القصوى
                                                    </label>
                                                    <input
                                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                        id="speed" type="text" placeholder=" السرعة القصوى"
                                                        wire:model="speed">
                                                    @error('speed')
                                                        <span
                                                            class="text-red-500">{{ 'الرجاء التأكد من السرعة القصوى' }}</span>
                                                    @enderror

                                                </div>


                                                <div class="mb-4">
                                                    <label class="block text-gray-700 font-bold mb-2" for="position">
                                                        مركز
                                                    </label>
                                                    <select wire:model="position" id="position" name="position"
                                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                        dir="rtl">
                                                        <option value="">اختر المركز </option>

                                                        <option value="ظهير ايمن">ظهير ايمن</option>
                                                        <option value="ظهير ايسر">ظهير ايسر</option>
                                                        <option value="قلب دفاع">قلب دفاع</option>
                                                        <option value="جناح ايمن">جناح ايمن</option>
                                                        <option value="جناح ايسر">جناح ايسر</option>
                                                        <option value="تمركز">تمركز </option>
                                                        <option value="تمركز هجومي">تمركز هجومي</option>
                                                        <option value="مهاجم">مهاجم </option>
                                                        <option value="رأس حربى">رأس حربى</option>
                                                        <option value="حارس مرمى">حارس مرمى</option>

                                                    </select>

                                                    @error('position')
                                                        <span
                                                            class="text-red-500">{{ 'الرجاء التأكد من القدم المسيطرة' }}</span>
                                                    @enderror

                                                </div>




                                                <div class="mb-4">
                                                    <label class="block text-gray-700 font-bold mb-2" for="strongFoot">
                                                        القدم المسيطرة
                                                    </label>
                                                    <select wire:model="strongFoot" id="strongFoot" name="strongFoot"
                                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                        dir="rtl">
                                                        <option value="">اختر القدم المسيطرة </option>

                                                        <option value="اليمنى">اليمنى</option>
                                                        <option value="اليسرى">اليسرى</option>

                                                    </select>

                                                    @error('strongFoot')
                                                        <span
                                                            class="text-red-500">{{ 'الرجاء التأكد من القدم المسيطرة' }}</span>
                                                    @enderror

                                                </div>

                                                @can('fullAccessUser')
                                                    <div class="mb-4">
                                                        <label class="block text-gray-700 font-bold mb-2" for="team">
                                                            يلعب في الفئة
                                                        </label>
                                                        <select wire:model="team" id="team" name="team"
                                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                            dir="rtl">
                                                            <option value="">اختر الفئة </option>

                                                            <option value="ناشئين">تحت 12</option>
                                                            <option value="براعم">تحت 14</option>
                                                            <option value="امال">تحت 16</option>
                                                            <option value="اواسط">تحت 18</option>



                                                        </select>
                                                        @error('team')
                                                            <span class="text-red-500">{{ 'الرجاء التأكد من الفئة' }}</span>
                                                        @enderror

                                                    </div>
                                                @endcan



                                                <div class="mb-4">
                                                    <label class="block text-gray-700 font-bold mb-2" for="health">
                                                        الحالة الصحية
                                                    </label>
                                                    <select wire:model="health" id="health" name="health"
                                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                        dir="rtl">
                                                        <option value="">اختر حالة الاعب </option>

                                                        <option value="يمكنه اللعب">يمكنه اللعب</option>
                                                        <option value="مصاب">مصاب</option>
                                                        <option value="مريض">مريض</option>



                                                    </select>
                                                    @error('health')
                                                        <span
                                                            class="text-red-500">{{ 'الرجاء التأكد من الحالة الصحية للاعب' }}</span>
                                                    @enderror

                                                </div>


                                                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                                    <button
                                                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-black text-base font-medium text-white hover:bg-gray-800 focus:outlineLet me continue where I left off:-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800 sm:ml-3 sm:w-auto sm:text-sm"
                                                        wire:click.prevent="addplayer"
                                                        x-on:click="closeModel ? showEditModal = false ">
                                                        اضافة
                                                    </button>
                                                    <button
                                                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                                                        x-on:click=" showModal = false" wire:click="propertyReset">
                                                        رجوع
                                                    </button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    {{-- here end the add model sorry for the long code --}}
            @endif





        </div>
        <div class="p-4">
            <div class="flex flex-col">
                <div class="overflow-x-auto">
                    <div class="inline-block min-w-full">
                        <div class="overflow-hidden border rounded-lg text right">
                            <table class="min-w-full divide-y divide-neutral-200">
                                <thead class="bg-neutral-50">
                                    <tr class="text-neutral-500">
                                        <th class="px-5 py-3 text-xs font-medium text-right ">موقوف</th>
                                        <th class="px-5 py-3 text-xs font-medium text-right ">رقم بطاقة العضوية</th>
                                        <th class="px-5 py-3 text-xs font-medium text-right ">اســــم الاعب</th>
                                        <th class="px-5 py-3 text-xs font-medium text-right ">طول الاعب</th>
                                        <th class="px-5 py-3 text-xs font-medium text-right ">القدم المسيطرة</th>
                                        <th class="px-5 py-3 text-xs font-medium text-right ">المركز</th>
                                        <th class="px-5 py-3 text-xs font-medium text-right ">تاريخ ميلادالاعب</th>

                                        <th class="px-5 py-3 text-xs font-medium text-right"></th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-neutral-200 text right">
                                    @foreach ($guys as $guy)
                                        <tr class="text-neutral-800 {{ $guy->status === false ? 'line-through' : '' }}">
                                            <td class="px-5 py-4 text-sm font-medium whitespace-nowrap"><input
                                                    type="checkbox" {{ $guy->status === false ? ' checked' : '' }}
                                                    wire:change="toggleplayer({{ $guy->pCardId }})"></td>
                                            <td class="px-5 py-4 text-sm font-medium whitespace-nowrap">
                                                {{ $guy->pCardId }}</td>
                                            <td class="px-5 py-4 text-sm whitespace-nowrap">{{ $guy->name }}</td>
                                            <td class="px-5 py-4 text-sm whitespace-nowrap">{{ $guy->height }}</td>
                                            <td class="px-5 py-4 text-sm whitespace-nowrap">{{ $guy->strongFoot }}
                                            <td class="px-5 py-4 text-sm whitespace-nowrap">{{ $guy->position }}
                                            </td>
                                            <td class="px-5 py-4 text-sm whitespace-nowrap">{{ $guy->birthDate }}</td>
                                            @can('fullAccessplayers')
                                                <td class="px-5 py-4 text-sm font-medium text-right whitespace-nowrap">
                                                    <div class="gap-3">
                                                        <span>
                                                            <button
                                                                class="inline-flex items-center px-2.5 py-1.5 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
                                                                x-on:click="showEditModal = true"
                                                                x-transition:enter="transition ease-out duration-300 transform"
                                                                x-transition:enter-start="opacity-0 scale-90"
                                                                x-transition:enter-end="opacity-100 scale-100"
                                                                x-transition:leave="transition ease-in duration-300 transform"
                                                                x-transition:leave-start="opacity-100 scale-100"
                                                                x-transition:leave-end="opacity-0 scale-90"
                                                                wire:click="lodeEditmodel({{ $guy->id }})">

                                                                تعديل
                                                            </button>
                                                        </span>
                                                        <button
                                                            onclick="confirm('هل تريد حذف المستخدم?') || event.stopImmediatePropagation()"
                                                            wire:click="delete({{ $guy->id }})"
                                                            class="inline-flex items-center px-2.5 py-1.5 border border-red-500 rounded-md font-semibold text-xs text-red-500 bg-white hover:bg-red-500 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                            حذف
                                                        </button>
                                                    </div>
                                                </td>
                                            @endcan


                                        </tr>
                                    @endforeach

                                    {{-- this the edit model --}}

                                    @if ($Editloaded)
                                        <div class="fixed z-10 inset-0 overflow-y-auto" x-show="showEditModal"
                                            x-transition:enter="transition ease-out duration-300"
                                            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                            x-transition:leave="transition ease-in duration-300"
                                            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

                                            <div
                                                class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                                <div class="fixed inset-0 transition-opacity" aria-hidden="true"
                                                    x-show="showEditModal"
                                                    x-transition:enter="transition ease-out duration-300"
                                                    x-transition:enter-start="opacity-0"
                                                    x-transition:enter-end="opacity-100"
                                                    x-transition:leave="transition ease-in duration-300"
                                                    x-transition:leave-start="opacity-100"
                                                    x-transition:leave-end="opacity-0">
                                                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                                                </div>

                                                <span class="hidden sm:inline-block sm:align-middle sm:h-screen"
                                                    aria-hidden="true">&#8203;</span>

                                                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                                                    x-show="showEditModal"
                                                    x-transition:enter="transition ease-out duration-300"
                                                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                                    x-transition:leave="transition ease-in duration-300"
                                                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                                                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                        <div class="sm:flex sm:items-start">
                                                            <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                                                                <h3
                                                                    class="text-lg leading-6 font-medium text-gray-900 text-right">
                                                                    تعديل بيانات الاعب
                                                                </h3>

                                                                <div class="mt-2 text-right">
                                                                    <form>
                                                                        <div class="mb-4">
                                                                            <label
                                                                                class="block text-gray-700 font-bold mb-2"
                                                                                for="pCardId">
                                                                                رقم بطاقة العضوية
                                                                            </label>
                                                                            <input
                                                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                                                id="pCardId" type="text"
                                                                                placeholder="رقم بطاقة العضوية"
                                                                                wire:model="pCardId">
                                                                            @error('name')
                                                                                <span
                                                                                    class="text-red-500">{{ 'الرجاء التأكد من رقم بطاقة العضوية' }}</span>
                                                                            @enderror

                                                                        </div>
                                                                        <div class="mb-4">
                                                                            <label
                                                                                class="block text-gray-700 font-bold mb-2"
                                                                                for="name">
                                                                                اســــم
                                                                            </label>
                                                                            <input
                                                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                                                id="name" type="text"
                                                                                placeholder="اســــم" wire:model="name">
                                                                            @error('pCardId')
                                                                                <span
                                                                                    class="text-red-500">{{ 'الرجاء التأكد من اســــم' }}</span>
                                                                            @enderror

                                                                        </div>

                                                                        <div class="mb-4">
                                                                            <label
                                                                                class="block text-gray-700 font-bold mb-2"
                                                                                for="nationalNum">
                                                                                رقم الوطني
                                                                            </label>
                                                                            <input
                                                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                                                id="nationalNum" type="text"
                                                                                placeholder=" رقم الوطني"
                                                                                wire:model="nationalNum">
                                                                            @error('nationalNum')
                                                                                <span
                                                                                    class="text-red-500">{{ 'الرجاء التأكد من رقم الوطني' }}</span>
                                                                            @enderror

                                                                        </div>

                                                                        <div class="mb-4">
                                                                            <label
                                                                                class="block text-gray-700 font-bold mb-2"
                                                                                for="birthDate">
                                                                                تاريخ الميلاد
                                                                            </label>
                                                                            <input
                                                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight text-right focus:outline-none focus:shadow-outline"
                                                                                id="birthDate" type="date"
                                                                                wire:model="birthDate">
                                                                            @error('birthDate')
                                                                                <span
                                                                                    class="text-red-500">{{ 'الرجاء التأكد من تاريخ الميلاد' }}</span>
                                                                            @enderror

                                                                        </div>

                                                                        <div class="mb-4">
                                                                            <label
                                                                                class="block text-gray-700 font-bold mb-2"
                                                                                for="height">
                                                                                الطول
                                                                            </label>
                                                                            <input
                                                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                                                id="height" type="text"
                                                                                placeholder="الطول" wire:model="height">
                                                                            @error('height')
                                                                                <span
                                                                                    class="text-red-500">{{ 'الرجاء التأكد من الطول' }}</span>
                                                                            @enderror

                                                                        </div>


                                                                        <div class="mb-4">
                                                                            <label
                                                                                class="block text-gray-700 font-bold mb-2"
                                                                                for="weight">
                                                                                الوزن
                                                                            </label>
                                                                            <input
                                                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                                                id="weight" type="text"
                                                                                placeholder="الوزن" wire:model="weight">
                                                                            @error('weight')
                                                                                <span
                                                                                    class="text-red-500">{{ 'الرجاء التأكد من الطول' }}</span>
                                                                            @enderror

                                                                        </div>

                                                                        <div class="mb-4">
                                                                            <label
                                                                                class="block text-gray-700 font-bold mb-2"
                                                                                for="speed">
                                                                                السرعة القصوى
                                                                            </label>
                                                                            <input
                                                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                                                id="speed" type="text"
                                                                                placeholder=" السرعة القصوى"
                                                                                wire:model="speed">
                                                                            @error('speed')
                                                                                <span
                                                                                    class="text-red-500">{{ 'الرجاء التأكد من السرعة القصوى' }}</span>
                                                                            @enderror

                                                                        </div>

                                                                        <div class="mb-4">
                                                                            <label
                                                                                class="block text-gray-700 font-bold mb-2"
                                                                                for="position">
                                                                                مركز
                                                                            </label>
                                                                            <select wire:model="position" id="position"
                                                                                name="position"
                                                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                                                dir="rtl">
                                                                                <option value="">اختر المركز
                                                                                </option>

                                                                                <option value="ظهير ايمن">ظهير ايمن
                                                                                </option>

                                                                                <option value="ظهير ايسر">ظهير ايسر
                                                                                </option>

                                                                                <option value="قلب دفاع">قلب دفاع</option>
                                                                                <option value="جناح ايمن">جناح ايمن
                                                                                </option>

                                                                                <option value="جناح ايسر">جناح ايسر
                                                                                </option>

                                                                                <option value="تمركز">تمركز </option>
                                                                                <option value="تمركز هجومي">تمركز هجومي
                                                                                </option>

                                                                                <option value="مهاجم">مهاجم </option>
                                                                                <option value="رأس حربى">رأس حربى</option>
                                                                                <option value="حارس مرمى">حارس مرمى
                                                                                </option>


                                                                            </select>

                                                                            @error('position')
                                                                                <span
                                                                                    class="text-red-500">{{ 'الرجاء التأكد من القدم المسيطرة' }}</span>
                                                                            @enderror

                                                                        </div>


                                                                        <div class="mb-4">
                                                                            <label
                                                                                class="block text-gray-700 font-bold mb-2"
                                                                                for="strongFoot">
                                                                                القدم المسيطرة
                                                                            </label>
                                                                            <select wire:model="strongFoot"
                                                                                id="strongFoot" name="strongFoot"
                                                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                                                dir="rtl">
                                                                                <option value="">اختر القدم
                                                                                    المسيطرة </option>

                                                                                <option value="اليمنى">اليمنى</option>
                                                                                <option value="اليسرى">اليسرى</option>

                                                                            </select>

                                                                            @error('strongFoot')
                                                                                <span
                                                                                    class="text-red-500">{{ 'الرجاء التأكد من القدم المسيطرة' }}</span>
                                                                            @enderror

                                                                        </div>
                                                                        @can('fullAccessUser')
                                                                            <div class="mb-4">
                                                                                <label
                                                                                    class="block text-gray-700 font-bold mb-2"
                                                                                    for="team">
                                                                                    يلعب في الفئة
                                                                                </label>
                                                                                <select wire:model="team" id="team"
                                                                                    name="team"
                                                                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                                                    dir="rtl">
                                                                                    <option value="">اختر الفئة </option>

                                                                                    <option value="ناشئين">تحت 12</option>
                                                                                    <option value="براعم">تحت 14</option>
                                                                                    <option value="امال">تحت 16</option>
                                                                                    <option value="اواسط">تحت 18</option>


                                                                                </select>
                                                                                @error('team')
                                                                                    <span
                                                                                        class="text-red-500">{{ 'الرجاء التأكد من الفئة' }}</span>
                                                                                @enderror

                                                                            </div>
                                                                        @endcan

                                                                        <div class="mb-4">
                                                                            <label
                                                                                class="block text-gray-700 font-bold mb-2"
                                                                                for="health">
                                                                                الحالة الصحية
                                                                            </label>
                                                                            <select wire:model="health" id="health"
                                                                                name="health"
                                                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                                                dir="rtl">
                                                                                <option value="">اختر حالة الاعب
                                                                                </option>

                                                                                <option value="يمكنه اللعب">يمكنه اللعب
                                                                                </option>
                                                                                <option value="مصاب">مصاب</option>
                                                                                <option value="مريض">مريض</option>



                                                                            </select>
                                                                            @error('health')
                                                                                <span
                                                                                    class="text-red-500">{{ 'الرجاء التأكد من الحالة الصحية للاعب' }}</span>
                                                                            @enderror

                                                                        </div>




                                                                        <div
                                                                            class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                                                            <button
                                                                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-black text-base font-medium text-white hover:bg-gray-800 focus:outlineLet me continue where I left off:-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800 sm:ml-3 sm:w-auto sm:text-sm"
                                                                                wire:click.prevent="editplayer({{ $edit_id }})"
                                                                                x-on:click="closeModel ? showEditModal = false ">
                                                                                تعديل
                                                                            </button>
                                                                            <button
                                                                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                                                                                x-on:click=" showEditModal = false"
                                                                                wire:click="propertyReset">
                                                                                رجوع
                                                                            </button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    @endif
                                    {{-- this the end of the edit model sorry for the inconvenience --}}


                                </tbody>
                            </table>




                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endcan

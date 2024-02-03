@can('fullAccessUser')

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
                                            اضافة مستخدم
                                        </h3>

                                        <div class="mt-2 text-right">
                                            <form>
                                                <div class="mb-4">
                                                    <label class="block text-gray-700 font-bold mb-2" for="name">
                                                        اســــم
                                                    </label>
                                                    <input
                                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                        id="name" type="text" placeholder="اســــم"
                                                        wire:model="name">
                                                    @error('name')
                                                        <span class="text-red-500">{{ 'الرجاء التأكد من اســــم' }}</span>
                                                    @enderror

                                                </div>

                                                <div class="mb-4">
                                                    <label class="block text-gray-700 font-bold mb-2" for="email">
                                                        البريد الاكتروني
                                                    </label>
                                                    <input
                                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                        id="email" type="email" placeholder=" البريد الاكتروني"
                                                        wire:model="email">
                                                    @error('email')
                                                        <span
                                                            class="text-red-500">{{ 'الرجاء التأكد من البريد الاكتروني' }}</span>
                                                    @enderror

                                                </div>




                                                <div class="mb-4">
                                                    <label class="block text-gray-700 font-bold mb-2" for="role">
                                                        مدرب او اداري
                                                    </label>
                                                    <select wire:model="role" id="role" name="role"
                                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                        dir="rtl">
                                                        <option value="">اختر مدرب او اداري </option>

                                                        <option value="مدرب">مدرب</option>
                                                        <option value="اداري">اداري</option>

                                                    </select>
                                                    @error('role')
                                                        <span class="text-red-500">{{ 'الرجاء التأكد من الصفة' }}</span>
                                                    @enderror

                                                </div>

                                                <div class="mb-4">
                                                    <label class="block text-gray-700 font-bold mb-2" for="repForTeam">
                                                        مسؤول عن الفئة
                                                    </label>
                                                    <select wire:model="repForTeam" id="repForTeam" name="repForTeam"
                                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                        dir="rtl">
                                                        <option value="">اختر الفئة </option>

                                                        <option value="ناشئين">ناشئين</option>
                                                        <option value="براعم">براعم</option>
                                                        <option value="امال">امال</option>
                                                        <option value="اواسط">اواسط</option>



                                                    </select>
                                                    @error('repForTeam')
                                                        <span class="text-red-500">{{ 'الرجاء التأكد من الفئة' }}</span>
                                                    @enderror

                                                </div>

                                                <div class="mb-4">
                                                    <label class="block text-gray-700 font-bold mb-2" for="password">
                                                        كلمة المرور
                                                    </label>
                                                    <input
                                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                        id="password" type="password" placeholder=" كلمة المرور"
                                                        wire:model="password">
                                                    @error('password')
                                                        <span class="text-red-500">{{ 'الرجاء التأكد من كلمة المرور' }}</span>
                                                    @enderror

                                                </div>
                                                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                                    <button
                                                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-black text-base font-medium text-white hover:bg-gray-800 focus:outlineLet me continue where I left off:-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800 sm:ml-3 sm:w-auto sm:text-sm"
                                                        wire:click.prevent="addUser"
                                                        x-on:click="closeModel ? showEditModal = false ">
                                                        حفظ
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
                                        <th class="px-5 py-3 text-xs font-medium text-right ">رقم المستخدم</th>
                                        <th class="px-5 py-3 text-xs font-medium text-right ">اســــم المستخدم</th>
                                        <th class="px-5 py-3 text-xs font-medium text-right ">البريد الاكتروني</th>
                                        <th class="px-5 py-3 text-xs font-medium text-right ">المسمة الوظيفي</th>
                                        <th class="px-5 py-3 text-xs font-medium text-right ">مسؤول عن الفئة </th>

                                        <th class="px-5 py-3 text-xs font-medium text-right"></th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-neutral-200 text right">
                                    @foreach ($users as $user)
                                        <tr class="text-neutral-800">
                                            <td class="px-5 py-4 text-sm font-medium whitespace-nowrap">{{ $user->id }}
                                            </td>
                                            <td class="px-5 py-4 text-sm whitespace-nowrap">{{ $user->name }}</td>
                                            <td class="px-5 py-4 text-sm whitespace-nowrap">{{ $user->email }}</td>
                                            <td class="px-5 py-4 text-sm whitespace-nowrap">{{ $user->role }}</td>
                                            <td class="px-5 py-4 text-sm whitespace-nowrap">{{ $user->repForTeam }}</td>

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
                                                            wire:click="lodeEditmodel({{ $user->id }})">

                                                            تعديل
                                                        </button>
                                                    </span>
                                                    <button
                                                        onclick="confirm('هل تريد حذف المستخدم?') || event.stopImmediatePropagation()"
                                                        wire:click="deleteuser({{ $user->id }})"
                                                        class="inline-flex items-center px-2.5 py-1.5 border border-red-500 rounded-md font-semibold text-xs text-red-500 bg-white hover:bg-red-500 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                        حذف
                                                    </button>
                                                </div>
                                            </td>


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
                                                                    تعديل بيانات المستخدم
                                                                </h3>

                                                                <div class="mt-2 text-right">
                                                                    <form>
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
                                                                            @error('name')
                                                                                <span
                                                                                    class="text-red-500">{{ 'الرجاء التأكد من اســــم' }}</span>
                                                                            @enderror

                                                                        </div>

                                                                        <div class="mb-4">
                                                                            <label
                                                                                class="block text-gray-700 font-bold mb-2"
                                                                                for="email">
                                                                                البريد الاكتروني
                                                                            </label>
                                                                            <input
                                                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                                                id="email" type="email"
                                                                                placeholder=" البريد الاكتروني"
                                                                                wire:model="email">
                                                                            @error('email')
                                                                                <span
                                                                                    class="text-red-500">{{ 'الرجاء التأكد من البريد الاكتروني' }}</span>
                                                                            @enderror

                                                                        </div>




                                                                        <div class="mb-4">
                                                                            <label
                                                                                class="block text-gray-700 font-bold mb-2"
                                                                                for="role">
                                                                                مدرب او اداري
                                                                            </label>
                                                                            <select wire:model="role" id="role"
                                                                                name="role"
                                                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                                                dir="rtl">
                                                                                <option value="">اختر مدرب او اداري
                                                                                </option>

                                                                                <option value="مدرب">مدرب</option>
                                                                                <option value="اداري">اداري</option>

                                                                            </select>
                                                                            @error('role')
                                                                                <span
                                                                                    class="text-red-500">{{ 'الرجاء التأكد من ادخال الصفة' }}</span>
                                                                            @enderror

                                                                        </div>

                                                                        <div class="mb-4">
                                                                            <label
                                                                                class="block text-gray-700 font-bold mb-2"
                                                                                for="repForTeam">
                                                                                مسؤول عن الفئة
                                                                            </label>
                                                                            <select wire:model="repForTeam"
                                                                                id="repForTeam" name="repForTeam"
                                                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                                                dir="rtl">
                                                                                <option value="">اختر الفئة </option>

                                                                                <option value="ناشئين">ناشئين</option>
                                                                                <option value="براعم">براعم</option>
                                                                                <option value="امال">امال</option>
                                                                                <option value="اواسط">اواسط</option>



                                                                            </select>
                                                                            @error('repForTeam')
                                                                                <span
                                                                                    class="text-red-500">{{ 'الرجاء التأكد من الفئة' }}</span>
                                                                            @enderror

                                                                        </div>

                                                                        <div class="mb-4">
                                                                            <label
                                                                                class="block text-gray-700 font-bold mb-2"
                                                                                for="password">
                                                                                كلمة المرور
                                                                            </label>
                                                                            <input
                                                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                                                id="password" type="password"
                                                                                placeholder=" كلمة المرور"
                                                                                wire:model="password">
                                                                            @error('password')
                                                                                <span
                                                                                    class="text-red-500">{{ 'الرجاء التأكد من كلمة المرور' }}</span>
                                                                            @enderror

                                                                        </div>
                                                                        <div
                                                                            class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                                                            <button
                                                                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-black text-base font-medium text-white hover:bg-gray-800 focus:outlineLet me continue where I left off:-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800 sm:ml-3 sm:w-auto sm:text-sm"
                                                                                wire:click.prevent="edituser({{ $edit_id }})"
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

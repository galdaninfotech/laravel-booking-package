<!DOCTYPE html>
<html
    lang="{{ app()->getLocale() }}"
    dir="{{ in_array(app()->getLocale(), ['ar', 'fa', 'he']) ? 'rtl' : 'ltr' }}"
>
    <head>
        <title>@lang('installer::app.installer.index.title')</title>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="base-url" content="{{ url()->to('/') }}">

        @stack('meta')

        @bagistoVite(['src/Resources/assets/css/app.css', 'src/Resources/assets/js/app.js'], 'installer')

        <link
            href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
            rel="stylesheet"
        />

        <link
            href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&display=swap"
            rel="stylesheet"
        />

        <link
            type="image/x-icon"
            href="{{ asset('images/installer/bagisto-logo.svg') }}"
            rel="shortcut icon"
            sizes="16x16"
        />

        @stack('styles')
    </head>

    @php
        $locales = [
            'ar'    => 'arabic',
            'bn'    => 'bengali',
            'pt_BR' => 'portuguese',
            'zh_CN' => 'chinese',
            'nl'    => 'dutch',
            'en'    => 'english',
            'fr'    => 'french',
            'de'    => 'german',
            'he'    => 'hebrew',
            'hi_IN' => 'hindi',
            'it'    => 'italian',
            'ja'    => 'japanese',
            'fa'    => 'persian',
            'pl'    => 'polish',
            'ru'    => 'russian',
            'sin'   => 'sinhala',
            'es'    => 'spanish',
            'tr'    => 'turkish',
            'uk'    => 'ukrainian',
        ];

        $currencies = [
            'CNY' => 'chinese-yuan',
            'AED' => 'dirham',
            'EUR' => 'euro',
            'INR' => 'rupee',
            'IRR' => 'iranian',
            'ILS' => 'israeli',
            'JPY' => 'japanese-yen',
            'GBP' => 'pound',
            'RUB' => 'russian-ruble',
            'SAR' => 'saudi',
            'TRY' => 'turkish-lira',
            'USD' => 'usd',
            'UAH' => 'ukrainian-hryvnia',
        ];
    @endphp

    <body>
        <div id="app" class="container">
            <div class="flex [&amp;>*]:w-[50%] gap-[50px] justify-center items-center">
                <!-- Vue Component -->
                <v-server-requirements></v-server-requirements>
            </div>
        </div>

        @pushOnce('scripts')
            <script type="text/x-template" id="v-server-requirements-template">
                <!-- Left Side Welcome to Installation -->
                <div class="flex flex-col justify-center">
                    <div class="grid items-end max-w-[362px] m-auto h-[100vh]">
                        <div class="grid gap-[16px]">
                            <img
                                src="{{ bagisto_asset('images/installer/bagisto-logo.svg', 'installer') }}"
                                alt="@lang('installer::app.installer.index.bagisto-logo')"
                            >

                            <div class="grid gap-[6px]">
                                <p class="text-gray-800 text-[20px] font-bold">
                                    @lang('installer::app.installer.index.installation-title')
                                </p>

                                <p class="text-gray-600 text-[14px]">
                                    @lang('installer::app.installer.index.installation-info')
                                </p>
                            </div>

                            <div class="grid gap-[12px]">
                                <div
                                    class="flex gap-[4px] text-[14px] text-gray-600"
                                    :class="[stepStates.start == 'active' ? 'font-bold' : '', 'text-gray-600']"
                                >
                                    <span v-if="stepStates.start !== 'complete'">
                                        <span
                                            class="text-[20px]"
                                            :class="stepStates.start === 'pending' ? 'icon-checkbox' : 'icon-processing'"
                                        >
                                        </span>
                                    </span>

                                    <span v-else>
                                        <span class="icon-tick text-green-500"></span>
                                    </span>

                                    <p>@lang('installer::app.installer.index.start.main')</p>
                                </div>

                                <!-- Server Environment -->
                                <div
                                    class="flex gap-[4px] text-[14px] text-gray-600"
                                    :class="[stepStates.serverRequirements == 'active' ? 'font-bold' : '', 'text-gray-600']"
                                >
                                    <span v-if="stepStates.serverRequirements !== 'complete'">
                                        <span
                                            class="text-[20px]"
                                            :class="stepStates.serverRequirements === 'pending' ? 'icon-checkbox' : 'icon-processing'"
                                        >
                                        </span>
                                    </span>

                                    <span v-else>
                                        <span class="icon-tick text-green-500"></span>
                                    </span>

                                    <p>@lang('installer::app.installer.index.server-requirements.title')</p>
                                </div>

                                <!-- ENV Database Configuration -->
                                <div
                                    class="flex gap-[4px] text-[14px] text-gray-600"
                                    :class="[stepStates.envDatabase == 'active' ? 'font-bold' : '', 'text-gray-600']"
                                >
                                    <span v-if="stepStates.envDatabase !== 'complete'">
                                        <span
                                            class="text-[20px]"
                                            :class="stepStates.envDatabase === 'pending' ? 'icon-checkbox' : 'icon-processing'"
                                        >
                                        </span>
                                    </span>

                                    <span v-else>
                                        <span class="icon-tick text-green-500"></span>
                                    </span>

                                    <p>
                                        @lang('installer::app.installer.index.environment-configuration.title')
                                    </p>
                                </div>

                                <!-- Ready For Installation -->
                                <div
                                    class="flex gap-[4px] text-[14px] text-gray-600"
                                    :class="[stepStates.readyForInstallation == 'active' ? 'font-bold' : '', 'text-gray-600']"
                                >
                                    <span v-if="stepStates.readyForInstallation !== 'complete'">
                                        <span
                                            class="text-[20px]"
                                            :class="stepStates.readyForInstallation === 'pending' ? 'icon-checkbox' : 'icon-processing'"
                                        >
                                        </span>
                                    </span>

                                    <span v-else>
                                        <span class="icon-tick text-green-500"></span>
                                    </span>

                                    <p>@lang('installer::app.installer.index.ready-for-installation.title')</p>
                                </div> 

                                <!-- Create Admin Configuration -->
                                <div
                                    class="flex gap-[4px] text-[14px] text-gray-600"
                                    :class="[stepStates.createAdmin == 'active' ? 'font-bold' : '', 'text-gray-600']"
                                >
                                    <span v-if="stepStates.createAdmin !== 'complete'">
                                        <span
                                            class="text-[20px]"
                                            :class="stepStates.createAdmin === 'pending' ? 'icon-checkbox' : 'icon-processing'"
                                        >
                                        </span>
                                    </span>

                                    <span v-else>
                                        <span class="icon-tick text-green-500"></span>
                                    </span>

                                    <p>@lang('installer::app.installer.index.create-administrator.title')</p>
                                </div>

                                <!-- Installation Completed -->
                                <div
                                    class="flex gap-[4px] text-[14px] text-gray-600"
                                    :class="[stepStates.installationCompleted == 'active' ? 'font-bold' : '', 'text-gray-600']"
                                >
                                    <span v-if="stepStates.installationCompleted !== 'complete'">
                                        <span
                                            class="text-[20px]"
                                            :class="stepStates.installationCompleted === 'pending' ? 'icon-checkbox' : 'icon-processing'"
                                        >
                                        </span>
                                    </span>

                                    <span v-else>
                                        <span class="icon-tick text-green-500"></span>
                                    </span>

                                    <p>@lang('installer::app.installer.index.installation-completed.title')</p>
                                </div>

                            </div>
                        </div>

                        <p class="place-self-end w-full text-left mb-[24px]">
                            <a
                                class="bg-white underline text-blue-500"
                                href="https://bagisto.com/en/"
                            >
                                @lang('installer::app.installer.index.bagisto')
                            </a>

                            <span>@lang('installer::app.installer.index.bagisto-info')</span>

                            <a
                                class="bg-white underline text-blue-500"
                                href="https://webkul.com/"
                            >
                                @lang('installer::app.installer.index.webkul')
                            </a>
                        </p>
                    </div>
                </div>

                <!-- Right Side Components -->
                <!-- Start -->
                <div class="w-full max-w-[568px] bg-white rounded-[8px] shadow-[0px_8px_10px_0px_rgba(0,0,0,0.05)] border-[1px] border-gray-300" v-if="currentStep == 'start'">
                    <x-installer::form
                        v-slot="{ meta, errors, handleSubmit }"
                        as="div"
                        ref="start"
                    >
                        <form
                            @submit.prevent="handleSubmit($event, setLocale)"
                            enctype="multipart/form-data"
                            ref="multiLocaleForm"
                        >
                            <div class="flex justify-between items-center gap-[10px] px-[16px] py-[11px] border-b-[1px] border-gray-300">
                                <p class="text-[20px] text-gray-800 font-bold">
                                    @lang('installer::app.installer.index.start.welcome-title')
                                </p>
                            </div>

                            <div class="flex flex-col gap-[12px] items-center h-[384px] px-[30px] py-[16px] overflow-y-auto">
                                <div class="container overflow-hidden">
                                    <div class="flex flex-col gap-[12px] justify-end h-[100px]">
                                        <p class="text-gray-600 text-[14px] text-center">
                                            @lang('installer::app.installer.index.installation-description')
                                        </p>
                                    </div>

                                    <div class="flex flex-col gap-[12px] justify-center h-[284px] px-[30px] py-[16px] overflow-y-auto">
                                        <!-- Application Name -->
                                        <x-installer::form.control-group class="mb-[10px]">
                                            <x-installer::form.control-group.label>
                                                @lang('Installation Wizard language')
                                            </x-installer::form.control-group.label>

                                            <x-installer::form.control-group.control
                                                type="select"
                                                name="locale"
                                                rules="required"
                                                :value="app()->getLocale()"
                                                :label="trans('installer::app.installer.index.start.locale')"
                                                value="{{ app()->getLocale() }}"
                                                @change="$refs.multiLocaleForm.submit();"
                                            >
                                                <option value="" disabled>@lang('installer::app.installer.index.start.select-locale')</option>

                                                @foreach ($locales as $value => $label)
                                                    <option value="{{ $value }}">
                                                        @lang("installer::app.installer.index.$label")
                                                    </option>
                                                @endforeach
                                            </x-installer::form.control-group.control>

                                            <x-installer::form.control-group.error
                                                control-name="locale"
                                            >
                                            </x-installer::form.control-group.error>
                                        </x-installer::form.control-group>
                                    </div>
                                </div>
                            </div>
                        
                            <div class="flex px-[16px] py-[10px] justify-end items-center">
                                <button
                                    type="button"
                                    class="px-[12px] py-[6px] bg-blue-600 border border-blue-700 rounded-[6px] text-gray-50 font-semibold cursor-pointer hover:opacity-90"
                                    tabindex="0"
                                    @click="nextForm"
                                >
                                    @lang('installer::app.installer.index.continue')
                                </button>
                            </div>
                        </form>
                    </x-installer::form>
                </div>

                <!-- Server Requirements -->
                <div class="w-full max-w-[568px] bg-white rounded-[8px] shadow-[0px_8px_10px_0px_rgba(0,0,0,0.05)] border-[1px] border-gray-300" v-if="currentStep == 'serverRequirements'">
                    <div class="flex justify-between items-center gap-[10px] px-[16px] py-[11px] border-b-[1px] border-gray-300">
                        <p class="text-[20px] text-gray-800 font-bold">
                            @lang('installer::app.installer.index.server-requirements.title')
                        </p>
                    </div>

                    <div class="flex flex-col gap-[15px] px-[30px] py-[16px] border-b-[1px] border-gray-300 h-[486px] overflow-y-auto">
                        <div class="flex gap-[4px]">
                            <span class="{{ $phpVersion['supported'] ? 'icon-tick text-[20px] text-green-500' : '' }}"></span>

                            <p class="text-[14px] text-gray-600 font-semibold">
                                @lang('installer::app.installer.index.server-requirements.php') <span class="font-normal">(@lang('installer::app.installer.index.server-requirements.php-version'))</span>
                            </p>
                        </div>

                        @foreach ($requirements['requirements'] as $requirement)
                            @foreach ($requirement as $key => $item)
                                <div class="flex gap-[4px]">
                                    <span class="{{ $item ? 'icon-tick text-green-500' : 'icon-cross text-red-500' }} text-[20px]"></span>

                                    <p class="text-[14px] text-gray-600 font-semibold">
                                        @lang('installer::app.installer.index.server-requirements.' . $key)
                                    </p>
                                </div>
                            @endforeach
                        @endforeach
                    </div>

                    @php
                        $hasRequirement = false;

                        foreach ($requirements['requirements']['php'] as $value) {
                            if (!$value) {
                                $hasRequirement = true;
                                break;
                            }
                        }
                    @endphp

                    <div class="flex px-[16px] py-[10px] justify-between items-center">
                        <div
                            class="text-[12px] text-blue-600 font-semibold cursor-pointer"
                            role="button"
                            aria-label="@lang('installer::app.installer.index.back')"
                            tabindex="0"
                            @click="back"
                        >
                            @lang('installer::app.installer.index.back')
                        </div>

                        <div
                            class="{{ $hasRequirement ? 'opacity-50 cursor-not-allowed' : ''}} px-[12px] py-[6px] bg-blue-600 border border-blue-700 rounded-[6px] text-gray-50 font-semibold cursor-pointer {{ $hasRequirement ?: 'hover:opacity-90' }}"
                            @click="nextForm"
                            tabindex="0"
                        >
                            @lang('installer::app.installer.index.continue')
                        </div>
                    </div>
                </div>

                <!-- Environment Configuration Database -->
                <div
                    class="w-full max-w-[568px] bg-white rounded-[8px] shadow-[0px_8px_10px_0px_rgba(0,0,0,0.05)] border-[1px] border-gray-300"
                    v-if="currentStep == 'envDatabase'"
                >
                    <x-installer::form
                        v-slot="{ meta, errors, handleSubmit }"
                        as="div"
                        ref="envDatabase"
                    >
                        <form
                            @submit.prevent="handleSubmit($event, FormSubmit)"
                            enctype="multipart/form-data"
                        >
                            <div class="flex justify-between items-center gap-[10px] px-[16px] py-[11px] border-b-[1px] border-gray-300">
                                <p class="text-[20px] text-gray-800 font-bold">
                                    @lang('installer::app.installer.index.environment-configuration.title')
                                </p>
                            </div>

                            <div class="flex flex-col gap-[12px] px-[30px] py-[16px] border-b-[1px] border-gray-300 h-[484px] overflow-y-auto">
                                <!-- Database Connection-->
                                <x-installer::form.control-group class="mb-[10px]">
                                    <x-installer::form.control-group.label class="required">
                                        @lang('installer::app.installer.index.environment-configuration.database-connection')
                                    </x-installer::form.control-group.label>

                                    <x-installer::form.control-group.control
                                        type="select"
                                        name="db_connection"
                                        ::value="envData.db_connection ?? 'mysql'"
                                        rules="required"
                                        :label="trans('installer::app.installer.index.environment-configuration.database-connection')"
                                        :placeholder="trans('installer::app.installer.index.environment-configuration.database-connection')"
                                    >
                                        <option
                                            value="mysql"
                                            selected
                                        >
                                            @lang('installer::app.installer.index.environment-configuration.mysql')
                                        </option>

                                        <option value="pgsql">@lang('installer::app.installer.index.environment-configuration.pgsql')</option>
                                        <option value="sqlsrv">@lang('installer::app.installer.index.environment-configuration.sqlsrv')</option>
                                    </x-installer::form.control-group.control>

                                    <x-installer::form.control-group.error
                                        control-name="db_connection"
                                    >
                                    </x-installer::form.control-group.error>
                                </x-installer::form.control-group>

                                <!-- Database Hostname-->
                                <x-installer::form.control-group class="mb-[10px]">
                                    <x-installer::form.control-group.label class="required">
                                        @lang('installer::app.installer.index.environment-configuration.database-hostname')
                                    </x-installer::form.control-group.label>

                                    <x-installer::form.control-group.control
                                        type="text"
                                        name="db_hostname"
                                        ::value="envData.db_hostname ?? '127.0.0.1'"
                                        rules="required"
                                        :label="trans('installer::app.installer.index.environment-configuration.database-hostname')"
                                        :placeholder="trans('installer::app.installer.index.environment-configuration.database-hostname')"
                                    >
                                    </x-installer::form.control-group.control>

                                    <x-installer::form.control-group.error
                                        control-name="db_hostname"
                                    >
                                    </x-installer::form.control-group.error>
                                </x-installer::form.control-group>

                                <!-- Database Port-->
                                <x-installer::form.control-group class="mb-[10px]">
                                    <x-installer::form.control-group.label class="required">
                                        @lang('installer::app.installer.index.environment-configuration.database-port')
                                    </x-installer::form.control-group.label>

                                    <x-installer::form.control-group.control
                                        type="text"
                                        name="db_port"
                                        ::value="envData.db_port ?? '3306'"
                                        rules="required"
                                        :label="trans('installer::app.installer.index.environment-configuration.database-port')"
                                        :placeholder="trans('installer::app.installer.index.environment-configuration.database-port')"
                                    >
                                    </x-installer::form.control-group.control>

                                    <x-installer::form.control-group.error
                                        control-name="db_port"
                                    >
                                    </x-installer::form.control-group.error>
                                </x-installer::form.control-group>

                                <!-- Database name-->
                                <x-installer::form.control-group class="mb-[10px]">
                                    <x-installer::form.control-group.label class="required">
                                        @lang('installer::app.installer.index.environment-configuration.database-name')
                                    </x-installer::form.control-group.label>

                                    <x-installer::form.control-group.control
                                        type="text"
                                        name="db_name"
                                        ::value="envData.db_name"
                                        rules="required"
                                        :label="trans('installer::app.installer.index.environment-configuration.database-name')"
                                        :placeholder="trans('installer::app.installer.index.environment-configuration.database-name')"
                                    >
                                    </x-installer::form.control-group.control>

                                    <x-installer::form.control-group.error
                                        control-name="db_name"
                                    >
                                    </x-installer::form.control-group.error>
                                </x-installer::form.control-group>

                                <!-- Database Prefix-->
                                <x-installer::form.control-group class="mb-[10px]">
                                    <x-installer::form.control-group.label>
                                        @lang('installer::app.installer.index.environment-configuration.database-prefix')
                                    </x-installer::form.control-group.label>

                                    <x-installer::form.control-group.control
                                        type="text"
                                        name="db_prefix"
                                        ::value="envData.db_prefix"
                                        :label="trans('installer::app.installer.index.environment-configuration.database-prefix')"
                                        :placeholder="trans('installer::app.installer.index.environment-configuration.database-prefix')"
                                    >
                                    </x-installer::form.control-group.control>

                                    <x-installer::form.control-group.error
                                        control-name="db_prefix"
                                    >
                                    </x-installer::form.control-group.error>
                                </x-installer::form.control-group>

                                <!-- Database Username-->
                                <x-installer::form.control-group class="mb-[10px]">
                                    <x-installer::form.control-group.label class="required">
                                        @lang('installer::app.installer.index.environment-configuration.database-username')
                                    </x-installer::form.control-group.label>

                                    <x-installer::form.control-group.control
                                        type="text"
                                        name="db_username"
                                        ::value="envData.db_username"
                                        rules="required"
                                        :label="trans('installer::app.installer.index.environment-configuration.database-username')"
                                        :placeholder="trans('installer::app.installer.index.environment-configuration.database-username')"
                                    >
                                    </x-installer::form.control-group.control>

                                    <x-installer::form.control-group.error
                                        control-name="db_username"
                                    >
                                    </x-installer::form.control-group.error>
                                </x-installer::form.control-group>

                                <!-- Database Password-->
                                <x-installer::form.control-group class="mb-[10px]">
                                    <x-installer::form.control-group.label class="required">
                                        @lang('installer::app.installer.index.environment-configuration.database-password')
                                    </x-installer::form.control-group.label>

                                    <x-installer::form.control-group.control
                                        type="password"
                                        name="db_password"
                                        ::value="envData.db_password"
                                        rules="required"
                                        :label="trans('installer::app.installer.index.environment-configuration.database-password')"
                                        :placeholder="trans('installer::app.installer.index.environment-configuration.database-password')"
                                    >
                                    </x-installer::form.control-group.control>

                                    <x-installer::form.control-group.error
                                        control-name="db_password"
                                    >
                                    </x-installer::form.control-group.error>
                                </x-installer::form.control-group>
                            </div>

                            <div class="flex px-[16px] py-[10px] justify-between items-center">
                                <div
                                    class="text-[12px] text-blue-600 font-semibold cursor-pointer"
                                    role="button"
                                    :aria-label="@lang('installer::app.installer.index.back')"
                                    tabindex="0"
                                    @click="back"
                                >
                                    @lang('installer::app.installer.index.back')
                                </div>

                                <button
                                    type="submit"
                                    class="px-[12px] py-[6px] bg-blue-600 border border-blue-700 rounded-[6px] text-gray-50 font-semibold cursor-pointer hover:opacity-90"
                                    tabindex="0"
                                >
                                    @lang('installer::app.installer.index.continue')
                                </button>
                            </div>
                        </form>
                    </x-installer::form>
                </div>

                <!-- Ready For Installation -->
                <div
                    class="w-full max-w-[568px] bg-white rounded-[8px] shadow-[0px_8px_10px_0px_rgba(0,0,0,0.05)] border-[1px] border-gray-300"
                    v-if="currentStep == 'readyForInstallation'"
                >
                    <x-installer::form
                        v-slot="{ meta, errors, handleSubmit }"
                        as="div"
                        ref="envDatabase"
                    >
                        <form
                            @submit.prevent="handleSubmit($event, FormSubmit)"
                            enctype="multipart/form-data"
                        >
                            <div class="flex justify-between items-center gap-[10px] px-[16px] py-[11px] border-b-[1px] border-gray-300">
                                <p class="text-[20px] text-gray-800 font-bold">
                                    @lang('installer::app.installer.index.ready-for-installation.install')
                                </p>
                            </div>

                            <div class="flex flex-col gap-[15px] justify-center px-[30px] py-[16px] border-b-[1px] border-gray-300 h-[484px] overflow-y-auto">
                                <div class="flex flex-col gap-[16px]">
                                    <p class="text-[18px] text-gray-800 font-semibold">
                                        @lang('installer::app.installer.index.ready-for-installation.install-info')
                                    </p>

                                    <div class="grid gap-[10px]">
                                        <label class="text-[14px] text-gray-600">
                                            @lang('installer::app.installer.index.ready-for-installation.install-info-button')
                                        </label>

                                        <div class="grid gap-[12px]">
                                            <div class="flex gap-[4px] text-[14px] text-gray-600">
                                                <span class="icon-processing text-[20px]"></span>

                                                <p>@lang('installer::app.installer.index.ready-for-installation.create-databsae-table')</p>
                                            </div>

                                            <div class="flex gap-[4px] text-[14px] text-gray-600">
                                                <span class="icon-processing text-[20px]"></span>

                                                <p>@lang('installer::app.installer.index.ready-for-installation.populate-database-table')</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex px-[16px] py-[10px] justify-between items-center">
                                <div
                                    class="text-[12px] text-blue-600 font-semibold cursor-pointer"
                                    role="button"
                                    :aria-label="@lang('installer::app.installer.index.back')"
                                    tabindex="0"
                                    @click="back"
                                >
                                    Back
                                </div>

                                <button
                                    type="submit"
                                    class="px-[12px] py-[6px] bg-blue-600 border border-blue-700 rounded-[6px] text-gray-50 font-semibold cursor-pointer hover:opacity-90"
                                >
                                    @lang('installer::app.installer.index.ready-for-installation.start-installation')
                                </button>
                            </div>
                        </form>
                    </x-installer::form>
                </div>

                <!-- Installation Processing -->
                <div
                    class="w-full max-w-[568px] bg-white rounded-[8px] shadow-[0px_8px_10px_0px_rgba(0,0,0,0.05)] border-[1px] border-gray-300"
                    v-if="currentStep == 'installProgress'"
                >
                    <div class="flex justify-between items-center gap-[10px] px-[16px] py-[11px] border-b-[1px] border-gray-300">
                        <p class="text-[20px] text-gray-800 font-bold">
                            @lang('installer::app.installer.index.installation-processing.title')
                        </p>
                    </div>

                    <div class="flex flex-col gap-[15px] justify-center px-[30px] py-[16px] h-[484px] overflow-y-auto">
                        <div class="flex flex-col gap-[16px]">
                            <p class="text-[18px] text-gray-800 font-bold">
                                @lang('installer::app.installer.index.installation-processing.bagisto')
                            </p>

                            <div class="grid gap-[10px]">
                                <!-- Spinner -->
                                <img
                                    class="animate-spin h-5 w-5 text-navyBlue"
                                    src="{{ bagisto_asset('images/installer/spinner.svg', 'installer') }}"
                                    alt="Loading"
                                />

                                <p class="text-[14px] text-gray-600">
                                    @lang('installer::app.installer.index.installation-processing.bagisto-info')
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Environment Configuration .ENV -->
                <div
                    class="w-full max-w-[568px] bg-white rounded-[8px] shadow-[0px_8px_10px_0px_rgba(0,0,0,0.05)] border-[1px] border-gray-300"
                    v-if="currentStep == 'envConfiguration'"
                >
                    <x-installer::form
                        v-slot="{ meta, errors, handleSubmit }"
                        as="div"
                        ref="envSetup"
                    >
                        <form
                            @submit.prevent="handleSubmit($event, nextForm)"
                            enctype="multipart/form-data"
                        >
                            <div class="flex justify-between items-center gap-[10px] px-[16px] py-[11px] border-b-[1px] border-gray-300">
                                <p class="text-[20px] text-gray-800 font-bold">
                                    @lang('installer::app.installer.index.environment-configuration.title')
                                </p>
                            </div>

                            <div class="flex flex-col gap-[12px] px-[30px] py-[16px] border-b-[1px] border-gray-300 h-[484px] overflow-y-auto">
                                <!-- Application Name -->
                                <x-installer::form.control-group class="mb-[10px]">
                                    <x-installer::form.control-group.label class="required">
                                        @lang('installer::app.installer.index.environment-configuration.application-name')
                                    </x-installer::form.control-group.label>

                                    <x-installer::form.control-group.control
                                        type="text"
                                        name="app_name"
                                        ::value="envData.app_name ?? 'Bagisto'"
                                        rules="required"
                                        :label="trans('installer::app.installer.index.environment-configuration.application-name')"
                                        :placeholder="trans('installer::app.installer.index.environment-configuration.bagisto')"
                                    >
                                    </x-installer::form.control-group.control>

                                    <x-installer::form.control-group.error
                                        control-name="app_name"
                                    >
                                    </x-installer::form.control-group.error>
                                </x-installer::form.control-group>

                                <!-- Application Default URL -->
                                <x-installer::form.control-group class="mb-[10px]">
                                    <x-installer::form.control-group.label class="required">
                                        @lang('installer::app.installer.index.environment-configuration.default-url')
                                    </x-installer::form.control-group.label>

                                    <x-installer::form.control-group.control
                                        type="text"
                                        name="app_url"
                                        ::value="envData.app_url ?? 'https://localhost'"
                                        rules="required"
                                        :label="trans('installer::app.installer.index.environment-configuration.default-url')"
                                        :placeholder="trans('installer::app.installer.index.environment-configuration.default-url-link')"
                                    >
                                    </x-installer::form.control-group.control>

                                    <x-installer::form.control-group.error
                                        control-name="app_url"
                                    >
                                    </x-installer::form.control-group.error>
                                </x-installer::form.control-group>

                                <!-- Application Default Timezone -->
                                <x-installer::form.control-group class="mb-[10px]">
                                    <x-installer::form.control-group.label class="required">
                                        @lang('installer::app.installer.index.environment-configuration.default-timezone')
                                    </x-installer::form.control-group.label>

                                    @php
                                        date_default_timezone_set('UTC');

                                        $tzlist = DateTimeZone::listIdentifiers(DateTimeZone::ALL);

                                        $current = date_default_timezone_get();
                                    @endphp

                                    <x-installer::form.control-group.control
                                        type="select"
                                        name="app_timezone"
                                        ::value="envData.app_timezone ?? $current"
                                        rules="required"
                                        :label="trans('installer::app.installer.index.environment-configuration.default-timezone')"
                                    >
                                        <option value="" disabled>Select Timezone</option>

                                        @foreach($tzlist as $key => $value)
                                            <option
                                                value="{{ $value }}"
                                                {{ $value === $current ? 'selected' : '' }}
                                            >
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </x-installer::form.control-group.control>

                                    <x-installer::form.control-group.error
                                        control-name="app_timezone"
                                    >
                                    </x-installer::form.control-group.error>
                                </x-installer::form.control-group>

                                <div class="p-[6px] border border-amber-400 bg-amber-100">
                                    <i class="icon-error text-black"></i>

                                    @lang('installer::app.installer.index.environment-configuration.warning-message')
                                </div>

                                <div class="flex gap-[10px]">
                                    <!-- Application Default Locale -->
                                    <x-installer::form.control-group class="w-full">
                                        <x-installer::form.control-group.label class="required">
                                            @lang('installer::app.installer.index.environment-configuration.default-locale')
                                        </x-installer::form.control-group.label>
    
                                        <x-installer::form.control-group.control
                                            type="select"
                                            name="app_locale"
                                            value="{{ app()->getLocale() }}"
                                            rules="required"
                                            :label="trans('installer::app.installer.index.environment-configuration.default-locale')"
                                        >
                                            @foreach ($locales as $value => $label)
                                                <option value="{{ $value }}">
                                                    @lang("installer::app.installer.index.$label")
                                                </option>
                                            @endforeach
                                        </x-installer::form.control-group.control>
    
                                        <x-installer::form.control-group.error
                                            control-name="app_locale"
                                        >
                                        </x-installer::form.control-group.error>
                                    </x-installer::form.control-group>

                                    <!-- Application Default Currency -->
                                    <x-installer::form.control-group class="w-full">
                                        <x-installer::form.control-group.label class="required">
                                            @lang('installer::app.installer.index.environment-configuration.default-currency')
                                        </x-installer::form.control-group.label>

                                        <x-installer::form.control-group.control
                                            type="select"
                                            name="app_currency"
                                            ::value="envData.app_currency ?? 'USD'"
                                            rules="required"
                                            :label="trans('installer::app.installer.index.environment-configuration.default-currency')"
                                        >
                                            <option value="" disabled>Select Currencies</option>
    
                                            @foreach ($currencies as $value => $label)
                                                <option value="{{ $value }}" @if($value == 'USD') selected @endif>
                                                    @lang("installer::app.installer.index.environment-configuration.$label")
                                                </option>
                                            @endforeach
                                        </x-installer::form.control-group.control>
    
                                        <x-installer::form.control-group.error
                                            control-name="app_currency"
                                        >
                                        </x-installer::form.control-group.error>
                                    </x-installer::form.control-group>
                                </div>

                                <div class="flex gap-[10px]">
                                    <x-installer::form.control-group class="w-full">
                                        <x-installer::form.control-group.label class="required">
                                            @lang('installer::app.installer.index.environment-configuration.allowed-locales')
                                        </x-installer::form.control-group.label>

                                        <!-- Allowed Locales -->
                                        @foreach ($locales as $key => $locale)
                                            <x-admin::form.control-group class="flex gap-[10px] w-max !mb-0 p-[6px] cursor-pointer select-none">
                                                @php
                                                    $selectedOption = ($key == app()->getLocale()) ? 0 : 1;
                                                @endphp

                                                <x-admin::form.control-group.control
                                                    type="checkbox"
                                                    name="{{ $key }}"
                                                    id="allowed_locale[{{ $key }}]"
                                                    for="allowed_locale[{{ $key }}]"
                                                    :value="(boolean) $selectedOption"
                                                    :disabled="(boolean) ! $selectedOption"
                                                    @change="pushAllowedLocales"
                                                >
                                                </x-admin::form.control-group.control>

                                                <x-admin::form.control-group.label
                                                    for="allowed_locale[{{ $key }}]"
                                                    class="!text-[14px] !font-semibold cursor-pointer"
                                                >
                                                    @lang("installer::app.installer.index.$locale")
                                                </x-admin::form.control-group.label>
                                            </x-admin::form.control-group>
                                        @endforeach
                                    </x-installer::form.control-group>

                                    <x-installer::form.control-group class="w-full">
                                        <x-installer::form.control-group.label class="required">
                                            @lang('installer::app.installer.index.environment-configuration.allowed-currencies')
                                        </x-installer::form.control-group.label>
    
                                        <!-- Allowed Currencies -->
                                        @foreach ($currencies as $key => $currency)
                                            <x-admin::form.control-group class="flex gap-[10px] w-max !mb-0 p-[6px] cursor-pointer select-none">
                                                @php
                                                    $selectedOption = ($key == 'USD') ? 0 : 1;
                                                @endphp

                                                <x-admin::form.control-group.control
                                                    type="checkbox"
                                                    name="{{ $key }}"
                                                    id="currency[{{ $key }}]"
                                                    for="currency[{{ $key }}]"
                                                    :value="(boolean) $selectedOption"
                                                    :disabled="(boolean) ! $selectedOption"
                                                    @change="pushAllowedCurrency"
                                                >
                                                </x-admin::form.control-group.control>

                                                <x-admin::form.control-group.label
                                                    for="currency[{{ $key }}]"
                                                    class="!text-[14px] !font-semibold cursor-pointer"
                                                >
                                                    @lang("installer::app.installer.index.environment-configuration.$currency")
                                                </x-admin::form.control-group.label>
                                            </x-admin::form.control-group>
                                        @endforeach
                                    </x-installer::form.control-group>
                                </div>
                            </div>

                            <div class="flex px-[16px] py-[10px] justify-between items-center">
                                <div
                                    class="text-[12px] text-blue-600 font-semibold cursor-pointer"
                                    role="button"
                                    aria-label="@lang('installer::app.installer.index.back')"
                                    tabindex="0"
                                    @click="back"
                                >
                                    @lang('installer::app.installer.index.back')
                                </div>

                                <button
                                    type="submit"
                                    class="px-[12px] py-[6px] bg-blue-600 border border-blue-700 rounded-[6px] text-gray-50 font-semibold cursor-pointer hover:opacity-90"
                                    tabindex="0"
                                >
                                    @lang('installer::app.installer.index.continue')
                                </button>
                            </div>

                        </form>
                    </x-installer::form>
                </div>

                <!-- Create Administrator -->
                <div
                    class="w-full max-w-[568px] bg-white rounded-[8px] shadow-[0px_8px_10px_0px_rgba(0,0,0,0.05)] border-[1px] border-gray-300"
                    v-if="currentStep == 'createAdmin'"
                >
                    <x-installer::form
                        v-slot="{ meta, errors, handleSubmit }"
                        as="div"
                        ref="createAdmin"
                    >
                        <form
                            @submit.prevent="handleSubmit($event, FormSubmit)"
                            enctype="multipart/form-data"
                        >
                            <div class="flex justify-between items-center gap-[10px] px-[16px] py-[11px] border-b-[1px] border-gray-300">
                                <p class="text-[20px] text-gray-800 font-bold">
                                    @lang('installer::app.installer.index.create-administrator.title')
                                </p>
                            </div>

                            <div class="flex flex-col gap-[12px] px-[30px] py-[16px] border-b-[1px] border-gray-300 h-[484px] overflow-y-auto">
                                <!-- Admin -->
                                <x-installer::form.control-group class="mb-[10px]">
                                    <x-installer::form.control-group.label class="required">
                                        @lang('installer::app.installer.index.create-administrator.admin')
                                    </x-installer::form.control-group.label>

                                    <x-installer::form.control-group.control
                                        type="text"
                                        name="admin"
                                        value="Admin"
                                        rules="required"
                                        :label="trans('installer::app.installer.index.create-administrator.admin')"
                                        :placeholder="trans('installer::app.installer.index.create-administrator.bagisto')"
                                    >
                                    </x-installer::form.control-group.control>

                                    <x-installer::form.control-group.error
                                        control-name="admin"
                                    >
                                    </x-installer::form.control-group.error>
                                </x-installer::form.control-group>

                                <!-- Email -->
                                <x-installer::form.control-group class="mb-[10px]">
                                    <x-installer::form.control-group.label class="required">
                                        @lang('installer::app.installer.index.create-administrator.email')
                                    </x-installer::form.control-group.label>

                                    <x-installer::form.control-group.control
                                        type="text"
                                        name="email"
                                        value="admin@example.com"
                                        rules="required"
                                        :label="trans('installer::app.installer.index.create-administrator.email')"
                                        :placeholder="trans('installer::app.installer.index.create-administrator.email-address')"
                                    >
                                    </x-installer::form.control-group.control>

                                    <x-installer::form.control-group.error
                                        control-name="email"
                                    >
                                    </x-installer::form.control-group.error>
                                </x-installer::form.control-group>

                                <!-- Password -->
                                <x-installer::form.control-group class="mb-[10px]">
                                    <x-installer::form.control-group.label class="required">
                                        @lang('installer::app.installer.index.create-administrator.password')
                                    </x-installer::form.control-group.label>

                                    <x-installer::form.control-group.control
                                        type="password"
                                        name="password"
                                        :value="old('password')"
                                        rules="required"
                                        :label="trans('installer::app.installer.index.create-administrator.password')"
                                    >
                                    </x-installer::form.control-group.control>

                                    <x-installer::form.control-group.error
                                        control-name="password"
                                    >
                                    </x-installer::form.control-group.error>
                                </x-installer::form.control-group>

                                <!-- Confirm Password -->
                                <x-installer::form.control-group class="mb-[10px]">
                                    <x-installer::form.control-group.label class="required">
                                        @lang('installer::app.installer.index.create-administrator.confirm-password')
                                    </x-installer::form.control-group.label>

                                    <x-installer::form.control-group.control
                                        type="password"
                                        name="confirm_password"
                                        :value="old('confirm_password')"
                                        rules="required|confirmed:@password"
                                        :label="trans('installer::app.installer.index.create-administrator.confirm-password')"
                                    >
                                    </x-installer::form.control-group.control>

                                    <x-installer::form.control-group.error
                                        control-name="confirm_password"
                                    >
                                    </x-installer::form.control-group.error>
                                </x-installer::form.control-group>
                            </div>

                            <div class="flex px-[16px] py-[10px] justify-end items-center">
                                <button
                                    type="submit"
                                    class="px-[12px] py-[6px] bg-blue-600 border border-blue-700 rounded-[6px] text-gray-50 font-semibold cursor-pointer hover:opacity-90"
                                    tabindex="0"
                                >
                                    @lang('installer::app.installer.index.continue')
                                </button>
                            </div>

                        </form>
                    </x-installer::form>
                </div>

                <!-- Installation Completed -->
                <div
                    class="w-full max-w-[568px] bg-white rounded-[8px] shadow-[0px_8px_10px_0px_rgba(0,0,0,0.05)] border-[1px] border-gray-300"
                    v-if="currentStep == 'installationCompleted'"
                >
                    <div class="flex justify-between items-center gap-[10px] px-[16px] py-[11px] border-b-[1px] border-gray-300">
                        <p class="text-[20px] text-gray-800 font-bold">
                            @lang('installer::app.installer.index.installation-completed.title')
                        </p>
                    </div>

                    <div class="flex flex-col gap-[15px] justify-center px-[30px] py-[16px] border-b-[1px] border-gray-300 h-[484px] overflow-y-auto">
                        <div class="flex flex-col gap-[16px]">
                            <div class="flex items-center justify-center rounded-full border border-green-500 w-[30px] h-[30px]">
                                <span class="icon-tick text-[20px] text-green-500 font-semibold"></span>
                            </div>

                            <div class="grid gap-[10px]">
                                <p class="text-[18px] text-gray-800 font-semibold">
                                    @lang('installer::app.installer.index.installation-completed.title')
                                </p>

                                <p class="text-[14px] text-gray-600">
                                    @lang('installer::app.installer.index.installation-completed.title-info')
                                </p>

                                <div class="flex justify-between items-center max-w-[288px]">
                                    <a
                                        href="{{ URL('/admin/login')}}"
                                        class="px-[12px] py-[6px] bg-white border border-blue-700 rounded-[6px] text-blue-600 font-semibold cursor-pointer hover:opacity-90"
                                    >
                                        @lang('installer::app.installer.index.installation-completed.admin-panel')
                                    </a>

                                    <a
                                        href="{{ URL('/')}}"
                                        class="px-[12px] py-[6px] bg-blue-600 border border-blue-700 rounded-[6px] text-gray-50 font-semibold cursor-pointer hover:opacity-90"
                                    >
                                        @lang('installer::app.installer.index.installation-completed.customer-panel')
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex px-[16px] py-[10px] justify-between items-center">
                        <a
                            href="https://forums.bagisto.com"
                            class="text-[12px] text-blue-600 font-semibold cursor-pointer"
                        >
                            @lang('installer::app.installer.index.installation-completed.bagisto-forums')
                        </a>

                        <a
                            href="https://bagisto.com/en/extensions"
                            class="px-[12px] py-[6px] bg-white border border-blue-700 rounded-[6px] text-blue-600 font-semibold cursor-pointer hover:opacity-90"
                        >
                            @lang('installer::app.installer.index.installation-completed.explore-bagisto-extensions')
                        </a>
                    </div>
                </div>
            </script>

            <script type="module">
                app.component('v-server-requirements', {
                    template: '#v-server-requirements-template',

                    data() {
                        return {
                            step: '',

                            currentStep: 'start',

                            envData: {},

                            locales: {
                                allowed: [],
                            },

                            currencies: {
                                allowed: [],
                            },

                            stepStates: {
                                start: 'active',
                                serverRequirements: 'pending',
                                envDatabase: 'pending',
                                readyForInstallation: 'pending',
                                envConfiguration: 'pending',
                                createAdmin: 'pending',
                                installationCompleted: 'pending',
                            },

                            steps: [
                                'start',
                                'serverRequirements',
                                'envDatabase',
                                'readyForInstallation',
                                'installProgress',
                                'envConfiguration',
                                'createAdmin',
                                'installationCompleted',
                            ],
                        }
                    },

                    methods: {
                        FormSubmit(params, { setErrors }) {
                            const stepActions = {
                                envDatabase: () => {
                                    if (params.db_connection === 'mysql') {
                                        this.completeStep('envDatabase', 'readyForInstallation', 'active', 'complete', setErrors);

                                        this.envData = { ...this.envData, ...params };
                                    } else {
                                        setErrors({ 'db_connection': ["Bagisto currently supports MySQL only."] });
                                    }
                                },

                                readyForInstallation: (setErrors) => {
                                    this.currentStep = 'installProgress';

                                    this.startMigration(setErrors);
                                },

                                createAdmin: (setErrors) => {
                                    this.completeStep('createAdmin', 'installationCompleted', 'active', 'complete', setErrors);

                                    this.saveAdmin(params, setErrors);
                                },
                            };

                            const index = this.steps.find(step => step === this.currentStep);

                            if (stepActions[index]) {
                                stepActions[index]();
                            }
                        },

                        nextForm(params) {
                            const stepActions = {
                                start: () => {
                                    this.completeStep('start', 'serverRequirements', 'active', 'complete');
                                },

                                serverRequirements: () => {
                                    this.completeStep('serverRequirements', 'envDatabase', 'active', 'complete');
                                    
                                    this.currentStep = 'envDatabase';
                                },

                                envConfiguration: () => {
                                    this.envData = { ...params };

                                    let data = {
                                        parameter: {
                                            default_locales: this.envData.app_locale,
                                            allowed_locales: this.locales.allowed,
                                            default_currency: this.envData.app_currency,
                                            allowed_currencies: this.currencies.allowed,
                                        },
                                    };

                                    console.log(data);

                                    this.startSeeding(data, this.envData);
                                },

                            };

                            const index = this.steps.find(step => step === this.currentStep);

                            if (stepActions[index]) {
                                stepActions[index]();
                            }
                        },

                        pushAllowedCurrency() {
                            const currencyName = event.target.name;

                            const index = this.currencies.allowed.indexOf(currencyName);

                            if (index === -1) {
                                this.currencies.allowed.push(currencyName);
                            } else {
                                this.currencies.allowed.splice(index, 1);
                            }
                        },

                        pushAllowedLocales() {
                            const localeName = event.target.name;

                            if (! Array.isArray(this.locales.allowed)) {
                            this.locales.allowed = [];
                            }

                            const index = this.locales.allowed.indexOf(localeName);

                            if (index === -1) {
                                this.locales.allowed.push(localeName);
                            } else {
                                this.locales.allowed.splice(index, 1);
                            }
                        },

                        completeStep(fromStep, toStep, toState, nextState, setErrors) {
                            this.stepStates[fromStep] = nextState;

                            this.currentStep = toStep;

                            this.stepStates[toStep] = toState;
                        },

                        startMigration(setErrors) {
                            this.currentStep = 'installProgress';

                            this.$axios.post("{{ route('installer.env_file_setup') }}", this.envData)
                                .then((response) => {
                                    this.runMigartion(setErrors);
                            })
                            .catch(error => {
                                setErrors(error.response.data.errors);
                            });
                        },

                        runMigartion(setErrors) {
                            this.$axios.post("{{ route('installer.run_migration') }}")
                                .then((response) => {
                                    this.completeStep('readyForInstallation', 'envConfiguration', 'active', 'complete');

                                    this.currentStep = 'envConfiguration';
                                })
                                .catch(error => {
                                    alert(error.response.data.error);

                                    this.currentStep = 'envDatabase';
                                });
                        },

                        startSeeding(selectedParams, allParameters) {
                            this.$axios.post("{{ route('installer.run_seeder') }}", {
                                'allParameters': allParameters,
                                'selectedParameters': selectedParams
                            })
                                .then((response) => {
                                    this.completeStep('envConfiguration', 'createAdmin', 'active', 'complete');

                                    this.currentStep = 'createAdmin';
                            })
                                .catch(error => {
                                    setErrors(error.response.data.errors);
                                });
                        },

                        saveAdmin(params, setErrors) {
                            this.$axios.post("{{ route('installer.admin_config_setup') }}", params)
                                .then((response) => {
                                    this.currentStep = 'installationCompleted';
                                })
                                .catch(error => {
                                    setErrors(error.response.data.errors);
                                });
                        },

                        setLocale(params) {
                            const newLocale = params.locale;
                            const url = new URL(window.location.href);

                            if (! url.searchParams.has('locale')) {
                                url.searchParams.set('locale', newLocale);
                                window.location.href = url.toString();
                            }
                        },

                        back() {
                            if (this.$refs[this.currentStep] && this.$refs[this.currentStep].setValues) {
                                this.$refs[this.currentStep].setValues(this.envData);
                            }

                            let index = this.steps.indexOf(this.currentStep);

                            if (index > 0) {
                                this.currentStep = this.steps[index - 1];
                            }
                        }
                    },
                });
            </script>
        @endPushOnce

        @stack('scripts')
    </body>
</html>

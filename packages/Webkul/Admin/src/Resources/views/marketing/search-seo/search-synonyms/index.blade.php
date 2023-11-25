<x-admin::layouts>
    <!-- Title of the page -->
    <x-slot:title>
        @lang('admin::app.marketing.search-seo.search-synonyms.index.title')
    </x-slot:title>

    {!! view_render_event('bagisto.admin.marketing.search_seo.search_synonyms.create.before') !!}

    <!-- Create Sitemap Vue Component -->
    <v-create-sitemaps>
        <div class="flex gap-[16px] justify-between items-center max-sm:flex-wrap">
            <p class="text-[20px] text-gray-800 dark:text-white font-bold">
                @lang('admin::app.marketing.search-seo.search-synonyms.index.title')
            </p>

            <!-- Create Button -->
            @if (bouncer()->hasPermission('marketing.search_seo.search_synonyms.create'))
                <div class="primary-button">
                    @lang('admin::app.marketing.search-seo.search-synonyms.index.create-btn')
                </div>
            @endif
        </div>

        <!-- Added For Shimmer -->
        <x-admin::shimmer.datagrid/>
    </v-create-sitemaps>

    {!! view_render_event('bagisto.admin.marketing.search_seo.search_synonyms.create.after') !!}

    @pushOnce('scripts')
        <script
            type="text/x-template"
            id="v-create-sitemaps-template"
        >
            <div class="flex gap-[16px] justify-between items-center max-sm:flex-wrap">
                <p class="text-[20px] text-gray-800 dark:text-white font-bold">
                    @lang('admin::app.marketing.search-seo.search-synonyms.index.title')
                </p>

                <!-- Create Button -->
                @if (bouncer()->hasPermission('marketing.search_seo.search_synonyms.create'))
                    <div
                        class="primary-button"
                        @click="selectedSitemap=0; $refs.sitemap.toggle()"
                    >
                        @lang('admin::app.marketing.search-seo.search-synonyms.index.create-btn')
                    </div>
                @endif
            </div>

            {!! view_render_event('admin.marketing.search_seo.search_synonyms.list.before') !!}

            <x-admin::datagrid
                src="{{ route('admin.marketing.search_seo.search_synonyms.index') }}"
                ref="datagrid"
            >
                <!-- DataGrid Body -->
                <template #body="{ columns, records, setCurrentSelectionMode, performAction, available, applied, isLoading }">
                    <template v-if="! isLoading">
                        <div
                            v-for="record in records"
                            class="row grid gap-[10px] items-center px-[16px] py-[16px] border-b-[1px] dark:border-gray-800 text-gray-600 dark:text-gray-300 transition-all hover:bg-gray-50 dark:hover:bg-gray-950"
                            :style="`grid-template-columns: repeat(${gridsCount}, minmax(0, 1fr))`"
                        >
                            <!-- Mass Actions -->
                            <p v-if="available.massActions.length">
                                <label :for="`mass_action_select_record_${record[available.meta.primary_column]}`">
                                    <input
                                        type="checkbox"
                                        class="peer hidden"
                                        :name="`mass_action_select_record_${record[available.meta.primary_column]}`"
                                        :value="record[available.meta.primary_column]"
                                        :id="`mass_action_select_record_${record[available.meta.primary_column]}`"
                                        v-model="applied.massActions.indices"
                                        @change="setCurrentSelectionMode"
                                    >

                                    <span class="icon-uncheckbox peer-checked:icon-checked peer-checked:text-blue-600 cursor-pointer rounded-[6px] text-[24px]">
                                    </span>
                                </label>
                            </p>

                            <!-- Id -->
                            <p v-text="record.id"></p>

                            <!-- Name -->
                            <p v-text="record.name"></p>

                            <!-- Terms -->
                            <p v-text="record.terms"></p>

                            <!-- Actions -->
                            @if (bouncer()->hasPermission('marketing.search_synonyms.edit') || bouncer()->hasPermission('marketing.search_synonyms.delete'))
                                <div class="flex justify-end">
                                    @if (bouncer()->hasPermission('marketing.search_synonyms.edit'))
                                        <a @click="selectedSitemap=1; editModal(record)">
                                            <span
                                                :class="record.actions.find(action => action.title === 'Edit')?.icon"
                                                class="cursor-pointer rounded-[6px] p-[6px] text-[24px] transition-all hover:bg-gray-100 dark:hover:bg-gray-950 max-sm:place-self-center"
                                            >
                                            </span>
                                        </a>
                                    @endif

                                    @if (bouncer()->hasPermission('marketing.search_synonyms.delete'))
                                        <a @click="performAction(record.actions.find(action => action.method === 'DELETE'))">
                                            <span
                                                :class="record.actions.find(action => action.method === 'DELETE')?.icon"
                                                class="cursor-pointer rounded-[6px] p-[6px] text-[24px] transition-all hover:bg-gray-100 dark:hover:bg-gray-950 max-sm:place-self-center"
                                            >
                                            </span>
                                        </a>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </template>

                    <!-- Datagrid Body Shimmer -->
                    <template v-else>
                        <x-admin::shimmer.datagrid.table.body></x-admin::shimmer.datagrid.table.body>
                    </template>
                </template>
            </x-admin::datagrid>

            {!! view_render_event('admin.marketing.search_seo.search_synonyms.list.after') !!}

            <!-- Model Form -->
            <x-admin::form
                v-slot="{ meta, errors, handleSubmit }"
                as="div"
                ref="modalForm"
            >
                <!-- Create Sitemap form -->
                <form
                    @submit="handleSubmit($event, updateOrCreate)"
                    ref="sitemapCreateForm"
                >
                    <x-admin::modal ref="sitemap">
                        <!-- Modal Header -->
                        <x-slot:header>
                            <!-- Create Modal title -->
                            <p
                                class="text-[18px] text-gray-800 dark:text-white font-bold"
                                v-if="selectedSitemap"
                            >
                                @lang('admin::app.marketing.search-seo.search-synonyms.index.edit.title')
                            </p>

                            <!-- Edit Modal title -->
                            <p
                                class="text-[18px] text-gray-800 dark:text-white font-bold"
                                v-else
                            >
                                @lang('admin::app.marketing.search-seo.search-synonyms.index.create.title')
                            </p>
                        </x-slot:header>

                        <!-- Modal Content -->
                        <x-slot:content>
                            <div class="px-[16px] py-[10px] border-b-[1px] dark:border-gray-800">
                                <!-- Id -->
                                <x-admin::form.control-group.control
                                    type="hidden"
                                    name="id"
                                >
                                </x-admin::form.control-group.control>

                                <!-- Name -->
                                <x-admin::form.control-group class="mb-[10px]">
                                    <x-admin::form.control-group.label class="required">
                                        @lang('admin::app.marketing.search-seo.search-synonyms.index.create.name')
                                    </x-admin::form.control-group.label>

                                    <x-admin::form.control-group.control
                                        type="text"
                                        name="name"
                                        rules="required"
                                        :label="trans('admin::app.marketing.search-seo.search-synonyms.index.create.name')"
                                        :placeholder="trans('admin::app.marketing.search-seo.search-synonyms.index.create.name')"
                                    >
                                    </x-admin::form.control-group.control>

                                    <x-admin::form.control-group.error
                                        control-name="name"
                                    >
                                    </x-admin::form.control-group.error>
                                </x-admin::form.control-group>

                                <!-- Terms -->
                                <x-admin::form.control-group class="mb-[10px]">
                                    <x-admin::form.control-group.label class="required">
                                        @lang('admin::app.marketing.search-seo.search-synonyms.index.create.terms')
                                    </x-admin::form.control-group.label>

                                    <x-admin::form.control-group.control
                                        type="textarea"
                                        name="terms"
                                        rules="required"
                                        :label="trans('admin::app.marketing.search-seo.search-synonyms.index.create.terms')"
                                        :placeholder="trans('admin::app.marketing.search-seo.search-synonyms.index.create.terms')"
                                    >
                                    </x-admin::form.control-group.control>

                                    <p class="mt-[8px] ltr:ml-[4px] rtl:mr-[4px] text-[12px] text-gray-600 dark:text-gray-300 font-medium">
                                        @lang('admin::app.marketing.search-seo.search-synonyms.index.create.terms-info')
                                    </p>

                                    <x-admin::form.control-group.error
                                        control-name="terms"
                                    >
                                    </x-admin::form.control-group.error>
                                </x-admin::form.control-group>
                            </div>
                        </x-slot:content>

                        <x-slot:footer>
                            <!-- Save Button -->
                            <button class="primary-button">
                                @lang('admin::app.marketing.search-seo.search-synonyms.index.create.save-btn')
                            </button>
                        </x-slot:footer>
                    </x-admin::modal>
                </form>
            </x-admin::form>
        </script>

        <script type="module">
            app.component('v-create-sitemaps', {
                template: '#v-create-sitemaps-template',

                data() {
                    return {
                        selectedSitemap: 0,
                    }
                },

                computed: {
                    gridsCount() {
                        let count = this.$refs.datagrid.available.columns.length;

                        if (this.$refs.datagrid.available.actions.length) {
                            ++count;
                        }

                        if (this.$refs.datagrid.available.massActions.length) {
                            ++count;
                        }

                        return count;
                    },
                },

                methods: {
                    updateOrCreate(params, { resetForm, setErrors }) {
                        let formData = new FormData(this.$refs.sitemapCreateForm);

                        if (params.id) {
                            formData.append('_method', 'put');
                        }

                        this.$axios.post(params.id ? "{{ route('admin.marketing.search_seo.search_synonyms.update') }}" : "{{ route('admin.marketing.search_seo.search_synonyms.store') }}", formData )
                            .then((response) => {
                                this.$emitter.emit('add-flash', { type: 'success', message: response.data.message });

                                this.$refs.sitemap.toggle();

                                this.$refs.datagrid.get();

                                resetForm();
                            })
                            .catch(error => {
                                if (error.response.status == 422) {
                                    setErrors(error.response.data.errors);
                                }
                            });
                    },

                    editModal(values) {
                        this.$refs.sitemap.toggle();

                        this.$refs.modalForm.setValues(values);
                    },
                },
            })
        </script>
    @endPushOnce
</x-admin::layouts>

{!! view_render_event('bagisto.admin.catalog.product.edit.form.links.before', ['product' => $product]) !!}
    
<v-product-links></v-product-links>

{!! view_render_event('bagisto.admin.catalog.product.edit.form.links.before', ['product' => $product]) !!}

@pushOnce('scripts')
    <script type="text/x-template" id="v-product-links-template">
        <div class="grid gap-[10px]">
            <!-- Panel -->
            <div
                class="relative bg-white dark:bg-gray-900 rounded-[4px] box-shadow"
                v-for="type in types"
            >
                <div class="flex gap-[20px] justify-between mb-[10px] p-[16px]">
                    <div class="flex flex-col gap-[8px]">
                        <p
                            class="text-[16px] text-gray-800 dark:text-white font-semibold"
                            v-text="type.title"
                        >
                        </p>

                        <p
                            class="text-[12px] text-gray-500 dark:text-gray-300 font-medium"
                            v-text="type.info"
                        >
                        </p>
                    </div>
                    
                    <!-- Add Button -->
                    <div class="flex gap-x-[4px] items-center">
                        <div
                            class="secondary-button"
                            @click="selectedType = type.key; $refs.productSearch.openDrawer()"
                        >
                            @lang('admin::app.catalog.products.edit.links.add-btn')
                        </div>
                    </div>
                </div>

                <!-- Product Listing -->
                <div
                    class="grid"
                    v-if="addedProducts[type.key].length"
                >
                    <div
                        class="flex gap-[10px] justify-between p-[16px] border-b-[1px] border-slate-300 dark:border-gray-800"
                        v-for="product in addedProducts[type.key]"
                    >
                        <!-- Hidden Input -->
                        <input
                            type="hidden"
                            :name="type.key + '[]'"
                            :value="product.id"
                        />

                        <!-- Information -->
                        <div class="flex gap-[10px]">
                            <!-- Image -->
                            <div
                                class="w-full h-[60px] max-w-[60px] max-h-[60px] relative rounded-[4px] overflow-hidden"
                                :class="{'border border-dashed border-gray-300 dark:border-gray-800 dark:invert dark:mix-blend-exclusion': ! product.images.length}"
                            >
                                <template v-if="! product.images.length">
                                    <img src="{{ bagisto_asset('images/product-placeholders/front.svg') }}">
                                
                                    <p class="w-full absolute bottom-[5px] text-[6px] text-gray-400 text-center font-semibold">
                                        @lang('admin::app.catalog.products.edit.links.image-placeholder')
                                    </p>
                                </template>
            
                                <template v-else>
                                    <img :src="product.images[0].url">
                                </template>
                            </div>

                            <!-- Details -->
                            <div class="grid gap-[6px] place-content-start">
                                <p
                                    class="text-[16x] text-gray-800 dark:text-white font-semibold"
                                    v-text="product.name"
                                >
                                </p>

                                <p class="text-gray-600 dark:text-gray-300">
                                    @{{ "@lang('admin::app.catalog.products.edit.links.sku')".replace(':sku', product.sku) }}
                                </p>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="grid gap-[4px] place-content-start text-right">
                            <p class="text-gray-800 font-semibold dark:text-white">
                                @{{ $admin.formatPrice(product.price) }}    
                            </p>

                            <p
                                class="text-red-600 cursor-pointer transition-all hover:underline"
                                @click="remove(type.key, product)"
                            >
                                @lang('admin::app.catalog.products.edit.links.delete')
                            </p>
                        </div>
                    </div>
                </div>

                <!-- For Empty Variations -->
                <div
                    class="grid gap-[14px] justify-center justify-items-center py-[40px] px-[10px] "
                    v-else
                >
                    <!-- Placeholder Image -->
                    <img
                        src="{{ bagisto_asset('images/icon-add-product.svg') }}"
                        class="w-[80px] h-[80px] dark:invert dark:mix-blend-exclusion"
                    />

                    <!-- Add Variants Information -->
                    <div class="flex flex-col gap-[5px] items-center">
                        <p class="text-[16px] text-gray-400 font-semibold">
                            @lang('admin::app.catalog.products.edit.links.empty-title')
                        </p>

                        <p
                            class="text-gray-400"
                            v-text="type.empty_info"
                        >
                        </p>
                    </div>
                </div>
            </div>

            <!-- Product Search Blade Component -->
            <x-admin::products.search
                ref="productSearch"
                ::added-product-ids="addedProductIds"
                @onProductAdded="addSelected($event)"
            ></x-admin::products.search>
        </div>
    </script>

    <script type="module">
        app.component('v-product-links', {
            template: '#v-product-links-template',

            data() {
                return {
                    currentProduct: @json($product),

                    selectedType: 'related_products',

                    types: [
                        {
                            key: 'related_products',
                            title: "@lang('admin::app.catalog.products.edit.links.related-products.title')",
                            info: "@lang('admin::app.catalog.products.edit.links.related-products.info')",
                            empty_info: "@lang('admin::app.catalog.products.edit.links.related-products.empty-info')",
                        }, {
                            key: 'up_sells',
                            title: "@lang('admin::app.catalog.products.edit.links.up-sells.title')",
                            info: "@lang('admin::app.catalog.products.edit.links.up-sells.info')",
                            empty_info: "@lang('admin::app.catalog.products.edit.links.up-sells.empty-info')",
                        }, {
                            key: 'cross_sells',
                            title: "@lang('admin::app.catalog.products.edit.links.cross-sells.title')",
                            info: "@lang('admin::app.catalog.products.edit.links.cross-sells.info')",
                            empty_info: "@lang('admin::app.catalog.products.edit.links.cross-sells.empty-info')",
                        }
                    ],

                    addedProducts: {
                        'up_sells': @json($product->up_sells()->with('images')->get()),

                        'cross_sells': @json($product->cross_sells()->with('images')->get()),

                        'related_products': @json($product->related_products()->with('images')->get())
                    },
                }
            },

            computed: {
                addedProductIds() {
                    let productIds = this.addedProducts[this.selectedType].map(product => product.id);

                    productIds.push(this.currentProduct.id);

                    return productIds;
                }
            },

            methods: {
                addSelected(selectedProducts) {
                    this.addedProducts[this.selectedType] = [...this.addedProducts[this.selectedType], ...selectedProducts];
                },

                remove(type, product) {
                    this.$emitter.emit('open-confirm-modal', {
                        agree: () => {
                            this.addedProducts[type] = this.addedProducts[type].filter(item => item.id !== product.id);
                        },
                    });
                },

                totalQty(product) {
                    let qty = 0;

                    product.inventories.forEach(function (inventory) {
                        qty += inventory.qty;
                    });

                    return qty;
                }
            }
        });
    </script>
@endPushOnce
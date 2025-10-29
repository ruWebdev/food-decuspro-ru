<script setup>
import LKPrimaryLayout from '@/Layouts/LKPrimaryLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    title: { type: String, required: true },
    description: { type: String, required: true },
});
</script>

<template>
    <LKPrimaryLayout>

        <Head :title="props.title" />

        <!-- section-cabinet -->
        <section class="section-cabinet section-cabinet-recepty">
            <!-- section-title -->
            <section class="section-recept-catalog">
                <section class="section-title">
                    <h1 class="h1 h1-vhod h1-lk">{{ props.title }}</h1>
                    <div class="section-title-right">
                        <div class="blok-search blok-search-2">
                            <form action="#" method="post" class="search">
                                <input type="search" placeholder="Поиск в меню" class="input" />
                                <input type="submit" value="" class="submit" />
                            </form>
                        </div>
                        <div class="title-sort"><img src="/img/icon-sort-2.png" alt="sort" /></div>
                        <Link class="button-1 button-lk-3 button-lk-5 button-recepty-1" :href="route('recipes.create')">{{ __('Добавить рецепт') }}</Link>
                    </div>
                </section>

                <!-- section-title-2 -->
                <section class="section-title-2">
                    <p class="section-title-2-text">{{ __('Все меню') }}</p>
                    <div class="section-title-2-right">
                        <select class="pole pole-filter" name="filter" id="pole-filter">
                            <option value="">{{ __('Фильтр') }}</option>
                            <option value="1">{{ __('пункт 1') }}</option>
                            <option value="2">{{ __('пункт 2') }}</option>
                            <option value="3">{{ __('пункт 3') }}</option>
                        </select>
                    </div>
                </section>

                <!-- katalog-menu -->
                <section class="katalog-menu">
                    <div class="blok-tab-title">
                        <div class="tab-title-element tab-title-element-1">{{ __('Все') }}</div>
                        <div class="tab-title-element tab-title-element-2">{{ __('Завтрак') }}</div>
                        <div class="tab-title-element tab-title-element-3">{{ __('Обед') }}</div>
                        <div class="tab-title-element tab-title-element-4">{{ __('Полдник') }}</div>
                        <div class="tab-title-element tab-title-element-5">{{ __('Ужин') }}</div>
                    </div>
                    <div class="katalog-menu-right">
                        <p class="reiting-bluda-text katalog-menu-right-text">{{ __('Сортировать по:') }}</p>
                        <select class="pole pole-filter pole-filter-2" name="sort" id="pole-filter-2">
                            <option value="calories">{{ __('Калории') }}</option>
                            <option value="fat">{{ __('Жиры') }}</option>
                            <option value="carbs">{{ __('Углеводы') }}</option>
                            <option value="protein">{{ __('Белок') }}</option>
                        </select>
                    </div>
                    <div class="katalog-rezerv"></div>
                </section>

                <!-- grid placeholder -->
                <div class="blok-tab-body blok-tab-body-1">
                    <div class="katalog-item">
                        <div class="katalog-item-image">
                            <img src="/img/recept-image-1.png" alt="bludo" />
                        </div>
                        <div class="katalog-item-info">
                            <div class="katalog-item-info-up">
                                <div class="katalog-item-blok-category">
                                    <p class="category-bluda category-bluda-1">{{ __('Завтрак') }}</p>
                                    <p class="slognost-bluda">{{ __('Легко') }}</p>
                                </div>
                                <Link :href="route('recipes.show', 'tost-s-avokado-i-yaycom')">
                                <h2 class="h2 h2-katalog">{{ __('Тост с авокадо и яйцом') }}</h2>
                                </Link>
                            </div>
                            <div class="katalog-item-info-down">
                                <p class="katalog-item-text">Скоро здесь появятся рецепты, подобранные специально</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </LKPrimaryLayout>
</template>

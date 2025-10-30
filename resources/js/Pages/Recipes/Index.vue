<script setup>
import LKPrimaryLayout from '@/Layouts/LKPrimaryLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import SearchForm from '@/Components/SearchForm.vue';
import SectionTitle from '@/Components/SectionTitle.vue';
import TabsCategories from '@/Components/TabsCategories.vue';
import SortBar from '@/Components/SortBar.vue';
import RecipeCard from '@/Components/RecipeCard.vue';

const props = defineProps({
    title: { type: String, required: true },
    description: { type: String, required: false, default: '' },
});

const categories = [
    { value: 'all', label: 'Все' },
    { value: 'breakfast', label: 'Завтрак' },
    { value: 'lunch', label: 'Обед' },
    { value: 'snack', label: 'Полдник' },
    { value: 'dinner', label: 'Ужин' },
    { value: 'pp', label: 'Правильное питание' },
];
</script>

<template>
    <LKPrimaryLayout>

        <Head :title="props.title" />

        <section class="section-cabinet section-cabinet-recepty">
            <section class="section-recept-catalog">
                <!-- title -->
                <SectionTitle :title="props.title">
                    <template #right>
                        <SearchForm :placeholder="__('Поиск в меню')" />
                        <div class="title-sort"><img src="/img/icon-sort-2.png" alt="sort" /></div>
                        <Link class="button-1 button-lk-3 button-lk-5 button-recepty-1" :href="route('recipes.create')">
                        {{ __('Добавить рецепт') }}</Link>
                    </template>
                </SectionTitle>

                <!-- title-2 -->
                <section class="section-title-2 d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <p class="section-title-2-text m-0">{{ __('Все меню') }}</p>
                    <div class="section-title-2-right">
                        <select class="pole pole-filter" name="filter" id="pole-filter">
                            <option value="">{{ __('Фильтр') }}</option>
                            <option value="1">{{ __('пункт 1') }}</option>
                            <option value="2">{{ __('пункт 2') }}</option>
                            <option value="3">{{ __('пункт 3') }}</option>
                            <option value="4">{{ __('пункт 4') }}</option>
                            <option value="5">{{ __('пункт 5') }}</option>
                        </select>
                    </div>
                </section>

                <!-- katalog-menu -->
                <section class="katalog-menu d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <TabsCategories :categories="categories" />
                    <SortBar />
                    <div class="katalog-rezerv"></div>
                </section>

                <!-- recipes grid -->
                <div class="blok-tab-body blok-tab-body-1">
                    <div class="row g-4">
                        <div class="col-12">
                            <RecipeCard image="/img/recept-image-1.png" :href="route('recipes.show', 'tost-s-avokado')"
                                :title="__('Тост с авокадо и яйцом-пашот')" category="Завтрак"
                                categoryClass="category-bluda-1" difficulty="Легко" :rating="5" kcal="320 ккал"
                                carbs="30г углеводы" protein="14г белок" fat="18г жиры" />
                        </div>
                        <div class="col-12">
                            <RecipeCard image="/img/recept-image-2.png"
                                :href="route('recipes.show', 'tako-s-krevetkami')"
                                :title="__('Тако с креветками на гриле и сальсой из манго')" category="Обед"
                                categoryClass="category-bluda-2" difficulty="Средний" :rating="3" kcal="400 ккал"
                                carbs="45г углеводы" protein="28г белок" fat="12г жиры" />
                        </div>
                        <div class="col-12">
                            <RecipeCard image="/img/recept-image-3.png"
                                :href="route('recipes.show', 'kurinaya-grudka-s-kinoa')"
                                :title="__('Запеченная куриная грудка с киноа и капустой Кале')" category="Ужин"
                                categoryClass="category-bluda-3" difficulty="Средний" :rating="4" kcal="480 ккал"
                                carbs="50г углеводы" protein="40г белок" fat="15г жиры" />
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </LKPrimaryLayout>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import LKPrimaryLayout from '@/Layouts/LKPrimaryLayout.vue';

const props = defineProps({
  title: { type: String, required: true },
  description: { type: String, required: false },
});
</script>

<template>
  <LKPrimaryLayout>
    <Head :title="props.title" />
    <!-- section-cabinet-2 -->
    <section class="section-cabinet-wrap">
      <!-- section-cabinet -->
      <section class="section-cabinet section-cabinet-recepty">
        <!-- section-title -->
        <section class="section-recept-catalog">
          <section class="section-title">
            <h1 class="h1 h1-vhod h1-lk">{{ props.title }}</h1>
            <div class="section-title-right">
              <div class="blok-search blok-search-2">
                <form action="#" method="post" class="search">
                  <input type="search" name="" placeholder="Поиск в меню" class="input" />
                  <input type="submit" name="" value="" class="submit" />
                </form>
              </div>
              <div class="title-sort"><img src="/img/icon-sort-2.png" alt="sort" /></div>
              <a class="button-1 button-lk-3 button-lk-5 button-recepty-1 button-news-0" href="#">Добавить рецепт</a>
            </div>
          </section>

          <!-- section-title-2 -->
          <section class="section-title-2">
            <p class="section-title-2-text">Все новости</p>
          </section>

          <!-- katalog-menu -->
          <section class="katalog-menu">
            <div class="blok-tab-title">
              <div class="tab-title-element tab-title-element-1">Все</div>
              <div class="tab-title-element tab-title-element-2">Достижения пользователей</div>
              <div class="tab-title-element tab-title-element-3">Блюдо недели</div>
              <div class="tab-title-element tab-title-element-4">Новые рецепты</div>
            </div>
            <div class="katalog-menu-right" data-da=".katalog-rezerv,1340,0">
              <p class="reiting-bluda-text katalog-menu-right-text">Сортировать по:</p>
              <select class="pole pole-filter pole-filter-2" name="pets" id="pole-filter-2">
                <option value="">Дате</option>
                <option value="Дате">Дате</option>
                <option value="пункт 2">пункт 2</option>
                <option value="пункт 3">пункт 3</option>
                <option value="пункт 4">пункт 4</option>
                <option value="пункт 5">пункт 5</option>
              </select>
            </div>
            <div class="katalog-rezerv"></div>
          </section>

          <!-- news grid -->
          <div class="blok-tab-body blok-tab-body-1">
            <div class="news-blok-items">
              <div class="news-blok-item news-blok-item-1">
                <img class="news-image" src="/img/new-image-1.jpg" alt="new" />
                <p class="new-text-data">25 сентября 2025</p>
                <div class="katalog-item-blok-category" data-da=".katalog-item-down-1,1240,0">
                  <p class="category-bluda category-bluda-1">Завтрак</p>
                  <p class="slognost-bluda">Легко</p>
                </div>
                <a href="#">
                  <h2 class="h2 h2-katalog">Тост с авокадо и яйцом</h2>
                </a>
                <p class="new-text-data new-text">Чтобы добавить рецепт, нажмите на кнопку “добавить рецепт”</p>
                <Link class="button-1 button-lk-news" :href="route('news.show', 'demo')">Читать новость</Link>
              </div>

              <div class="news-blok-item news-blok-item-2">
                <img class="news-image" src="/img/new-image-1.jpg" alt="new" />
                <p class="new-text-data">25 сентября 2025</p>
                <div class="katalog-item-blok-category" data-da=".katalog-item-down-1,1240,0">
                  <p class="category-bluda category-bluda-1">Завтрак</p>
                  <p class="slognost-bluda">Легко</p>
                </div>
                <a href="#">
                  <h2 class="h2 h2-katalog">Тост с авокадо и яйцом, Тост с авокадо и яйцом ,Тост с авокадо и яйцом
                  </h2>
                </a>
                <p class="new-text-data new-text">Чтобы добавить рецепт, нажмите на кнопку “добавить рецепт”</p>
                <Link class="button-1 button-lk-news" :href="route('news.show', 'demo')">Читать новость</Link>
              </div>

              <div class="news-blok-item news-blok-item-3">
                <img class="news-image" src="/img/new-image-1.jpg" alt="new" />
                <p class="new-text-data">25 сентября 2025</p>
                <div class="katalog-item-blok-category" data-da=".katalog-item-down-1,1240,0">
                  <p class="category-bluda category-bluda-1">Завтрак</p>
                  <p class="slognost-bluda">Легко</p>
                </div>
                <a href="#">
                  <h2 class="h2 h2-katalog">Тост с авокадо и яйцом</h2>
                </a>
                <p class="new-text-data new-text">Чтобы добавить рецепт, нажмите на кнопку “добавить рецепт”</p>
                <Link class="button-1 button-lk-news" :href="route('news.show', 'demo')">Читать новость</Link>
              </div>

              <div class="news-blok-item news-blok-item-4">
                <img class="news-image" src="/img/new-image-1.jpg" alt="new" />
                <p class="new-text-data">25 сентября 2025</p>
                <div class="katalog-item-blok-category" data-da=".katalog-item-down-1,1240,0">
                  <p class="category-bluda category-bluda-1">Завтрак</p>
                  <p class="slognost-bluda">Легко</p>
                </div>
                <a href="#">
                  <h2 class="h2 h2-katalog">Тост с авокадо и яйцом</h2>
                </a>
                <p class="new-text-data new-text">Чтобы добавить рецепт, нажмите на кнопку “добавить рецепт”</p>
                <a class="button-1 button-lk-news" href="#">Читать новость</a>
              </div>

              <div class="news-blok-item news-blok-item-5">
                <img class="news-image" src="/img/new-image-1.jpg" alt="new" />
                <p class="new-text-data">25 сентября 2025</p>
                <div class="katalog-item-blok-category" data-da=".katalog-item-down-1,1240,0">
                  <p class="category-bluda category-bluda-1">Завтрак</p>
                  <p class="slognost-bluda">Легко</p>
                </div>
                <a href="#">
                  <h2 class="h2 h2-katalog">Тост с авокадо и яйцом</h2>
                </a>
                <p class="new-text-data new-text">Чтобы добавить рецепт, нажмите на кнопку “добавить рецепт”</p>
                <a class="button-1 button-lk-news" href="#">Читать новость</a>
              </div>

              <div class="news-blok-item news-blok-item-6">
                <img class="news-image" src="/img/new-image-1.jpg" alt="new" />
                <p class="new-text-data">25 сентября 2025</p>
                <div class="katalog-item-blok-category" data-da=".katalog-item-down-1,1240,0">
                  <p class="category-bluda category-bluda-1">Завтрак</p>
                  <p class="slognost-bluda">Легко</p>
                </div>
                <a href="#">
                  <h2 class="h2 h2-katalog">Тост с авокадо и яйцом</h2>
                </a>
                <p class="new-text-data new-text">Чтобы добавить рецепт, нажмите на кнопку “добавить рецепт”</p>
                <a class="button-1 button-lk-news" href="#">Читать новость</a>
              </div>

              <div class="news-blok-item news-blok-item-7">
                <img class="news-image" src="/img/new-image-1.jpg" alt="new" />
                <p class="new-text-data">25 сентября 2025</p>
                <div class="katalog-item-blok-category" data-da=".katalog-item-down-1,1240,0">
                  <p class="category-bluda category-bluda-1">Завтрак</p>
                  <p class="slognost-bluda">Легко</p>
                </div>
                <a href="#">
                  <h2 class="h2 h2-katalog">Тост с авокадо и яйцом</h2>
                </a>
                <p class="new-text-data new-text">Чтобы добавить рецепт, нажмите на кнопку “добавить рецепт”</p>
                <a class="button-1 button-lk-news" href="#">Читать новость</a>
              </div>

              <div class="news-blok-item news-blok-item-8">
                <img class="news-image" src="/img/new-image-1.jpg" alt="new" />
                <p class="new-text-data">25 сентября 2025</p>
                <div class="katalog-item-blok-category" data-da=".katalog-item-down-1,1240,0">
                  <p class="category-bluda category-bluda-1">Завтрак</p>
                  <p class="slognost-bluda">Легко</p>
                </div>
                <a href="#">
                  <h2 class="h2 h2-katalog">Тост с авокадо и яйцом</h2>
                </a>
                <p class="new-text-data new-text">Чтобы добавить рецепт, нажмите на кнопку “добавить рецепт”</p>
                <a class="button-1 button-lk-news" href="#">Читать новость</a>
              </div>

              <div class="news-blok-item news-blok-item-9">
                <img class="news-image" src="/img/new-image-1.jpg" alt="new" />
                <p class="new-text-data">25 сентября 2025</p>
                <div class="katalog-item-blok-category" data-da=".katalog-item-down-1,1240,0">
                  <p class="category-bluda category-bluda-1">Завтрак</p>
                  <p class="slognost-bluda">Легко</p>
                </div>
                <a href="#">
                  <h2 class="h2 h2-katalog">Тост с авокадо и яйцом</h2>
                </a>
                <p class="new-text-data new-text">Чтобы добавить рецепт, нажмите на кнопку “добавить рецепт”</p>
                <a class="button-1 button-lk-news" href="#">Читать новость</a>
              </div>
            </div>
          </div>

          <div class="blok-tab-body blok-tab-body-2">Тут пока нет новостей 2</div>
          <div class="blok-tab-body blok-tab-body-3">Тут пока нет новостей 3</div>
          <div class="blok-tab-body blok-tab-body-4">Тут пока нет новостей 4</div>
        </section>

        <!-- section-sidebar-right -->
        <section class="sidebar-right sidebar-right-2">
          <!-- lk-blok-popular -->
          <div class="lk-blok-popular">
            <h3 class="h3 h3-sidebar">Популярные блюда</h3>
            <div class="lk-blok-popular-element lk-blok-popular-element-1">
              <img class="lk-popular-element-image" src="/img/popul-bluda-Image-1.png" alt="popular" />
              <div class="lk-blok-popular-info">
                <div class="lk-blok-popular-info-1">
                  <h4 class="h4">Greek Salad with Feta and Olives</h4>
                  <a class="lk-blok-popular-link" href="#"><img src="/img/icon-Button-plus.png" alt="+" /></a>
                </div>
                <div class="lk-blok-popular-info-2">
                  <p class="lk-blok-popular-reiting"><img src="/img/icon-Star.png" alt="star" /><span>4.9</span>/5</p>
                  <p class="category-bluda category-bluda-2 category-bluda-popular">Обед</p>
                </div>
              </div>
            </div>

            <div class="lk-blok-popular-element lk-blok-popular-element-2">
              <img class="lk-popular-element-image" src="/img/popul-bluda-Image-2.png" alt="popular" />
              <div class="lk-blok-popular-info">
                <div class="lk-blok-popular-info-1">
                  <h4 class="h4">Blueberry Protein Smoothie</h4>
                  <a class="lk-blok-popular-link" href="#"><img src="/img/icon-Button-plus.png" alt="+" /></a>
                </div>
                <div class="lk-blok-popular-info-2">
                  <p class="lk-blok-popular-reiting"><img src="/img/icon-Star.png" alt="star" /><span>4.8</span>/5</p>
                  <p class="category-bluda category-bluda-1 category-bluda-popular">Завтрак</p>
                </div>
              </div>
            </div>

            <div class="lk-blok-popular-element lk-blok-popular-element-3">
              <img class="lk-popular-element-image" src="/img/popul-bluda-Image-3.png" alt="popular" />
              <div class="lk-blok-popular-info">
                <div class="lk-blok-popular-info-1">
                  <h4 class="h4">Grilled Salmon with Lemon and Asparagus</h4>
                  <a class="lk-blok-popular-link" href="#"><img src="/img/icon-Button-plus.png" alt="+" /></a>
                </div>
                <div class="lk-blok-popular-info-2">
                  <p class="lk-blok-popular-reiting"><img src="/img/icon-Star.png" alt="star" /><span>4.8</span>/5</p>
                  <p class="category-bluda category-bluda-3 category-bluda-popular">Ужин</p>
                </div>
              </div>
            </div>
          </div>

          <!-- lk-blok-moi-bluda -->
          <div class="lk-blok-popular lk-blok-moi-bluda">
            <h3 class="h3 h3-sidebar">Мои блюда</h3>
            <div class="lk-blok-moibluda-element lk-blok-moibluda-element-1">
              <div class="lk-blok-moibluda-element-up">
                <img class="lk-popular-element-image" src="/img/popul-bluda-Image-4.png" alt="popular" />
                <div class="lk-blok-moibluda-element-up-left">
                  <h4 class="h4">Овсяная каша с миндальным маслом</h4>
                  <div class="lk-blok-moibluda-element-up-left-down">
                    <p class="category-bluda category-bluda-1 category-bluda-popular">Завтрак</p>
                    <a class="lk-blok-popular-link lk-blok-popular-link-2" href="#"><img
                        src="/img/icon-Button-plus.png" alt="+" /></a>
                  </div>
                </div>
              </div>
              <div class="lk-blok-moibluda-element-down">
                <img src="/img/icon-kkal.png" alt="kkal" />
                <p class=""><span>C</span> 400 ккал</p>
                <img src="/img/icon-uglevod.png" alt="kkal" />
                <p class=""><span>C</span> 50г</p>
              </div>
            </div>
          </div>
        </section>
      </section>
    </section>
  </LKPrimaryLayout>
</template>

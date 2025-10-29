<script setup>
</script>

<template>
  <section class="sidebar-right" data-da=".section-down,940,0">
    <div class="lk-blok-user lk-blok-user-2">
      <div class="lk-blok-user-2-left">
        <img class="image-user" src="/img/cabinet-Image-2.png" alt="user" />
        <div class="lk-blok-text">
          <p class="lk-name">{{ __('Адам Василенко') }}</p>
          <p class="lk-status">{{ __('Участник') }}</p>
        </div>
      </div>
      <div class="lk-blok-uvedoml">
        <button type="button" class="lk-blok-popular-link" aria-label="messages">
          <img src="/img/icon-message-wrap-2.png" alt="message" />
        </button>
      </div>
    </div>

    <div class="lk-blok-popular">
      <h3 class="h3 h3-sidebar">{{ __('Популярные блюда') }}</h3>

      <div class="lk-blok-popular-element lk-blok-popular-element-1">
        <img class="lk-popular-element-image" src="/img/popul-bluda-Image-1.png" alt="popular" />
        <div class="lk-blok-popular-info">
          <div class="lk-blok-popular-info-1">
            <h4 class="h4">Greek Salad with Feta and Olives</h4>
            <a class="lk-blok-popular-link" href="#"><img src="/img/icon-Button-plus.png" alt="+" /></a>
          </div>
          <div class="lk-blok-popular-info-2">
            <p class="lk-blok-popular-reiting"><img src="/img/icon-Star.png" alt="star" /><span>4.9</span>/5</p>
            <p class="category-bluda category-bluda-2 category-bluda-popular">{{ __('Обед') }}</p>
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
            <p class="category-bluda category-bluda-1 category-bluda-popular">{{ __('Завтрак') }}</p>
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
            <p class="category-bluda category-bluda-3 category-bluda-popular">{{ __('Ужин') }}</p>
          </div>
        </div>
      </div>
    </div>

    <div class="lk-blok-popular lk-blok-moi-bluda">
      <h3 class="h3 h3-sidebar">{{ __('Мои блюда') }}</h3>

      <div class="lk-blok-moibluda-element lk-blok-moibluda-element-1">
        <div class="lk-blok-moibluda-element-up">
          <img class="lk-popular-element-image" src="/img/popul-bluda-Image-4.png" alt="popular" />
          <div class="lk-blok-moibluda-element-up-left">
            <h4 class="h4">{{ __('Овсяная каша с миндальным маслом') }}</h4>
            <div class="lk-blok-moibluda-element-up-left-down">
              <p class="category-bluda category-bluda-1 category-bluda-popular">{{ __('Завтрак') }}</p>
              <a class="lk-blok-popular-link lk-blok-popular-link-2" href="#"><img src="/img/icon-Button-plus.png" alt="+" /></a>
            </div>
          </div>
        </div>
        <div class="lk-blok-moibluda-element-down">
          <img src="/img/icon-kkal.png" alt="kkal" />
          <p class=""><span>C</span> 400 {{ __('ккал') }}</p>
          <img src="/img/icon-uglevod.png" alt="kkal" />
          <p class=""><span>C</span> 50{{ __('г') }}</p>
          <img src="/img/icon-belok.png" alt="kkal" />
          <p class=""><span>P</span> 15{{ __('г') }}</p>
          <img src="/img/icon-giri.png" alt="kkal" />
          <p class=""><span>F</span> 12{{ __('г') }}</p>
        </div>
      </div>

      <div class="lk-blok-moibluda-element lk-blok-moibluda-element-2">
        <div class="lk-blok-moibluda-element-up">
          <img class="lk-popular-element-image" src="/img/popul-bluda-Image-5.png" alt="popular" />
          <div class="lk-blok-moibluda-element-up-left">
            <h4 class="h4">{{ __('Куриное филе на гриле с авокадо и шпинатом') }}</h4>
            <div class="lk-blok-moibluda-element-up-left-down">
              <p class="category-bluda category-bluda-2 category-bluda-popular">{{ __('Обед') }}</p>
              <a class="lk-blok-popular-link lk-blok-popular-link-2" href="#"><img src="/img/icon-Button-plus.png" alt="+" /></a>
            </div>
          </div>
        </div>
        <div class="lk-blok-moibluda-element-down">
          <img src="/img/icon-kkal.png" alt="kkal" />
          <p class=""><span>C</span> 450 {{ __('ккал') }}</p>
          <img src="/img/icon-ugлевод.png" alt="kkal" />
          <p class=""><span>C</span> 40{{ __('г') }}</p>
          <img src="/img/icon-belok.png" alt="kkal" />
          <p class=""><span>P</span> 30{{ __('г') }}</p>
          <img src="/img/icon-giri.png" alt="kkal" />
          <p class=""><span>F</span> 18{{ __('г') }}</p>
        </div>
      </div>

      <div class="lk-blok-moibluda-element lk-blok-moibluda-element-3">
        <div class="lk-blok-moibluda-element-up">
          <img class="lk-popular-element-image" src="/img/popul-bluda-Image-6.png" alt="popular" />
          <div class="lk-blok-moibluda-element-up-left">
            <h4 class="h4">{{ __('Салат из киноа с запеченными овощами') }}</h4>
            <div class="lk-blok-moibluda-element-up-left-down">
              <p class="category-bluda category-bluda-3 category-bluda-popular">{{ __('Ужин') }}</p>
              <a class="lk-blok-popular-link lk-blok-popular-link-2" href="#"><img src="/img/icon-Button-plus.png" alt="+" /></a>
            </div>
          </div>
        </div>
        <div class="lk-blok-moibluda-element-down">
          <img src="/img/icon-kkal.png" alt="kkal" />
          <p class=""><span>C</span> 400 {{ __('ккал') }}</p>
          <img src="/img/icon-uglevod.png" alt="kkal" />
          <p class=""><span>C</span> 50{{ __('г') }}</p>
          <img src="/img/icon-belok.png" alt="kkal" />
          <p class=""><span>P</span> 15{{ __('г') }}</p>
          <img src="/img/icon-giri.png" alt="kkal" />
          <p class=""><span>F</span> 12{{ __('г') }}</p>
        </div>
      </div>
    </div>
  </section>
  <section class="section-down"></section>
</template>

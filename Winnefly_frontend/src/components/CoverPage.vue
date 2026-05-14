<!-- src/views/HomeView.vue -->
<template>
  <div>
    <!-- HERO SECTION -->
    <section class="hero-section">
      <!-- Decorative Circles -->
      <div class="shape shape-top-right"></div>
      <div class="shape shape-bottom-left"></div>

      <div class="container hero-content">
        <span class="hero-badge">
          ✨ Freshly baked every morning
        </span>

        <h1 class="hero-title">
          Where every bite is a
          <span>sweet memory</span>
        </h1>

        <p class="hero-description">
          Handcrafted pastries made with love, butter, and the finest
          ingredients — delivered to your door.
        </p>

        <div class="hero-buttons">
          <router-link to="/menu" class="btn btn-primary">
            Browse Menu
          </router-link>

          <a href="#our-story" class="btn btn-secondary">
            Our Story
          </a>
        </div>
      </div>
    </section>

    <!-- ABOUT SECTION -->
    <section id="our-story" class="about-section">
      <div class="container about-container">
        <div class="about-image">
          <img
            src="https://images.unsplash.com/photo-1517433670267-08bbd4be890f"
            alt="Bakery"
          />
        </div>

        <div class="about-content">
          <span class="section-badge">Our Story</span>

          <h2>Baked with passion since day one</h2>

          <p>
            We started with one simple dream: creating pastries that bring
            warmth, comfort, and unforgettable moments to every table.
          </p>

          <p>
            Every croissant, cake, and cookie is handcrafted daily using
            premium ingredients, traditional techniques, and a whole lot of
            love.
          </p>

          <p>
            From our kitchen to your home, we're here to make life's sweetest
            moments even sweeter.
          </p>

          <router-link to="/about" class="btn btn-primary">
            Learn More
          </router-link>
        </div>
      </div>
    </section>
  </div>
</template>

<style scoped>
/* ===========================
   GENERAL
=========================== */
.container {
  width: 90%;
  max-width: 1200px;
  margin: 0 auto;
}

/* ===========================
   HERO SECTION
=========================== */
.hero-section {
  position: relative;
  min-height: 100vh;
  background: linear-gradient(90deg, #d9e8ea 0%, #e8e5b9 100%);
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
}

.hero-content {
  text-align: center;
  z-index: 2;
  padding: 2rem 0;
}

.hero-badge {
  display: inline-block;
  padding: 0.75rem 1.5rem;
  background: rgba(255, 255, 255, 0.85);
  border-radius: 999px;
  font-size: 0.95rem;
  margin-bottom: 2rem;
  color: #5b3a34;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.hero-title {
  font-size: clamp(2.6rem, 6vw, 5rem);
  line-height: 1.05;
  color: #3b2624;
  font-weight: 700;
  margin-bottom: 1.2rem;
  letter-spacing: -2px;
}

.hero-title span {
  display: block;
  font-style: italic;
  color: #5B8DB8;
  font-family: "Cormorant Garamond", Georgia, serif;
  font-weight: 500;
  letter-spacing: 1px;
}

.hero-description {
  max-width: 680px;
  margin: 0 auto 2.5rem;
  font-size: 1.15rem;
  line-height: 1.9;
  color: #6B5550;
}

.hero-buttons {
  display: flex;
  justify-content: center;
  gap: 1.5rem;
  flex-wrap: wrap;
}

/* ===========================
   BUTTONS
=========================== */
.btn {
  display: inline-block;
  padding: 1rem 2.5rem;
  border-radius: 999px;
  text-decoration: none;
  font-size: 1.15rem;
  font-weight: 600;
  transition: all 0.3s ease;
}

.btn-primary {
  background: #4a2e2b;
  color: white;
}

.btn-primary:hover {
  background: #37211f;
  transform: translateY(-3px);
}

.btn-secondary {
  background: white;
  color: #4a2e2b;
  border: 1px solid #ddd;
}

.btn-secondary:hover {
  transform: translateY(-3px);
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

/* ===========================
   DECORATIONS
=========================== */
.shape {
  position: absolute;
  border-radius: 50%;
  opacity: 0.35;
}

.shape-top-right {
  width: 450px;
  height: 450px;
  background: #f6f1d7;
  top: -120px;
  right: -120px;
}

.shape-bottom-left {
  width: 350px;
  height: 350px;
  background: #f4eec8;
  bottom: -150px;
  left: -100px;
}

/* ===========================
   ABOUT SECTION
=========================== */
.about-section {
  padding: 7rem 0;
  background: #fffaf5;
}

.about-container {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 5rem;
  align-items: center;
}

.about-image img {
  width: 100%;
  border-radius: 30px;
  object-fit: cover;
  box-shadow: 0 20px 50px rgba(0, 0, 0, 0.12);
}

.section-badge {
  display: inline-block;
  background: #f4e7d8;
  color: #8b5e3c;
  padding: 0.6rem 1.4rem;
  border-radius: 999px;
  margin-bottom: 1.5rem;
  font-weight: 600;
}

.about-content h2 {
  font-size: clamp(2.5rem, 4vw, 4rem);
  color: #3b2624;
  margin-bottom: 1.3rem;
  line-height: 1.08;
  letter-spacing: -1.5px;
  font-family: "Cormorant Garamond", Georgia, serif;
  font-weight: 600;
}

.about-content p {
  font-size: 1rem;
  color: #6d5a55;
  line-height: 2;
  margin-bottom: 1.4rem;
  max-width: 600px;
}

/* ===========================
   RESPONSIVE
=========================== */
@media (max-width: 992px) {
  .about-container {
    grid-template-columns: 1fr;
  }

  .about-image {
    order: 1;
  }

  .about-content {
    order: 2;
    text-align: center;
  }

  .hero-description {
    font-size: 1.2rem;
  }
}
</style>
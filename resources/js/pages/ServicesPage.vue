<template>
  <div class="pg">

    <!-- PAGE HERO -->
    <div class="page-hero">
      <div class="ph-bg">
        <div class="ph-orb ph-orb-1"></div>
        <div class="ph-orb ph-orb-2"></div>
        <div class="ph-grid"></div>
      </div>
      <div class="container ph-body">
        <div class="breadcrumb" v-obs>
          <router-link to="/">Home</router-link>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M9 18l6-6-6-6" />
          </svg>
          <span>Services</span>
        </div>
        <div class="ph-tag" v-obs>Professional Garment Care</div>
        <h1 v-obs>Our <em class="accent">Services</em> &amp;<br>Transparent Pricing</h1>
        <p v-obs>Every garment treated with care. Every price listed upfront — no surprises, ever.</p>
        <div class="hero-stats" v-obs>
          <div class="stat" v-for="s in stats" :key="s.label">
            <strong>{{ s.val }}</strong>
            <span>{{ s.label }}</span>
          </div>
        </div>
      </div>
      <div class="scroll-hint" v-obs>
        <span>Explore Services</span>
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M12 5v14M5 12l7 7 7-7" />
        </svg>
      </div>
    </div>

    <!-- STICKY CATEGORY NAV -->
    <div class="cat-nav-wrap" ref="stickyNav">
      <div class="container">
        <div class="cat-nav">
          <button v-for="(cat, ci) in cats" :key="cat.title" class="cat-nav-btn" :class="{ active: activeTab === ci }"
            @click="scrollToCategory(ci)">
            <span class="cn-ico">{{ cat.icon }}</span>
            <span class="cn-label">{{ cat.shortTitle }}</span>
          </button>
        </div>
      </div>
    </div>

    <!-- SERVICE SECTIONS -->
    <section class="section">
      <div class="container">

        <div v-for="(cat, ci) in cats" :key="cat.title" class="cat-section" :ref="el => catRefs[ci] = el" v-obs
          :style="{ '--d': ci * 0.06 + 's' }">
          <!-- Image Banner -->
          <div class="cat-banner">
            <img :src="cat.img" :alt="cat.title" class="cat-banner-img" loading="lazy" />
            <div class="cat-banner-overlay">
              <div class="cat-banner-content">
                <div class="cat-ico-lg">{{ cat.icon }}</div>
                <div>
                  <div class="cat-pill-banner" v-if="cat.badge">{{ cat.badge }}</div>
                  <h2>{{ cat.title }}</h2>
                  <p>{{ cat.desc }}</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Price Grid -->
          <div class="price-grid-wrap">
            <div class="item-grid">
              <div class="item-card" v-for="item in cat.items" :key="item.name">
                <div class="item-thumb-wrap">
                  <img :src="item.img" :alt="item.name" class="item-thumb" loading="lazy" />
                </div>
                <div class="item-body">
                  <div class="item-name">{{ item.name }}</div>
                  <div class="item-sub" v-if="item.desc">{{ item.desc }}</div>
                  <div class="item-price-row">
                    <span class="item-price">&#8377;{{ item.price }}</span>
                    <span class="item-unit">per piece</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- ADD-ONS -->
        <div class="addons-section" v-obs>
          <div class="addons-header">
            <h3>Add-On Services</h3>
            <p>Enhance your order with premium treatments for even better results</p>
          </div>
          <div class="addons-grid">
            <div class="addon" v-for="a in addons" :key="a.name">
              <div class="addon-ico-wrap">
                <span class="addon-ico">{{ a.icon }}</span>
              </div>
              <div class="addon-info">
                <strong>{{ a.name }}</strong>
                <p>{{ a.desc }}</p>
              </div>
              <div class="addon-price-wrap">
                <span class="addon-price">&#8377;{{ a.price }}</span>
                <span class="addon-per">add-on</span>
              </div>
            </div>
          </div>
        </div>

        <!-- PRICING NOTE -->
        <div class="note" v-obs>
          <div class="note-icon">&#128161;</div>
          <div>
            <h4>Pricing Note</h4>
            <p>Prices shown are base rates. Final pricing may vary based on fabric type, garment size, stain severity,
              and embellishment level — all confirmed before we begin. <router-link to="/contact">Contact
                us</router-link> for custom quotes on bulk or bridal orders.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- HOW IT WORKS STRIP -->
    <div class="process-strip" v-obs>
      <div class="container">
        <div class="process-head">
          <h3>How It Works</h3>
          <p>Simple, transparent, doorstep-to-doorstep care</p>
        </div>
        <div class="steps">
          <div class="step" v-for="(st, i) in steps" :key="st.label">
            <div class="step-num">{{ String(i + 1).padStart(2, '0') }}</div>
            <div class="step-icon">{{ st.icon }}</div>
            <div class="step-label">{{ st.label }}</div>
            <div class="step-desc">{{ st.desc }}</div>
            <div class="step-arrow" v-if="i < steps.length - 1">&#8250;</div>
          </div>
        </div>
      </div>
    </div>

    <!-- BOTTOM CTA -->
    <div class="bot-cta" v-obs>
      <div class="cta-bg-img">
        <img src="https://images.unsplash.com/photo-1545173168-9f1947eebb7f?w=1600&q=80&fit=crop" alt=""
          aria-hidden="true" />
        <div class="cta-overlay"></div>
      </div>
      <div class="container bot-cta-row">
        <div class="cta-text">
          <div class="cta-eyebrow">Free Pickup &amp; Delivery</div>
          <h3>Ready to experience the<br><em class="accent">Chauhan difference?</em></h3>
          <p>Book your free pickup today. We collect, clean, and return — hassle-free.</p>
        </div>
        <div class="cta-actions">
          <router-link to="/booking" class="btn-gold">
            Schedule Free Pickup
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
              <path d="M5 12h14M12 5l7 7-7 7" />
            </svg>
          </router-link>
          <router-link to="/contact" class="btn-ghost">Get a Custom Quote</router-link>
        </div>
      </div>
    </div>

  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'

const vObs = {
  mounted(el) {
    const d = el.style.getPropertyValue('--d') || '0s'
    el.style.cssText += `opacity:0;transform:translateY(28px);transition:opacity .7s ease ${d},transform .7s ease ${d};`
    const io = new IntersectionObserver(([e]) => {
      if (e.isIntersecting) { el.style.opacity = '1'; el.style.transform = 'translateY(0)'; io.disconnect() }
    }, { threshold: 0.06 })
    io.observe(el)
  }
}

const stickyNav = ref(null)
const catRefs = ref([])
const activeTab = ref(0)

function scrollToCategory(i) {
  activeTab.value = i
  const el = catRefs.value[i]
  if (el) {
    const navH = stickyNav.value?.offsetHeight || 58
    const top = el.getBoundingClientRect().top + window.scrollY - navH - 20
    window.scrollTo({ top, behavior: 'smooth' })
  }
}

let observer = null
onMounted(() => {
  observer = new IntersectionObserver(entries => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        const i = catRefs.value.findIndex(r => r === e.target)
        if (i !== -1) activeTab.value = i
      }
    })
  }, { threshold: 0.3 })
  catRefs.value.forEach(r => r && observer.observe(r))
})
onUnmounted(() => observer?.disconnect())

const stats = [
  { val: '5000+', label: 'Happy Customers' },
  { val: '12+', label: 'Years Experience' },
  { val: '48hr', label: 'Standard Turnaround' },
  { val: '100%', label: 'Satisfaction Guarantee' },
]

const steps = [
  { icon: '📅', label: 'Book Pickup', desc: 'Schedule online or call us anytime' },
  { icon: '🚗', label: 'Free Collection', desc: 'We collect from your doorstep' },
  { icon: '🧼', label: 'Expert Cleaning', desc: 'Treated with care in our facility' },
  { icon: '🚪', label: 'Home Delivery', desc: 'Returned fresh, folded & on time' },
]

const IMGS = {
  tshirt: 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=300&q=70&fit=crop',
  shirt: 'https://images.unsplash.com/photo-1602810316693-3667c854239a?w=300&q=70&fit=crop',
  jeans: 'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?w=300&q=70&fit=crop',
  trousers: 'https://images.unsplash.com/photo-1594938298603-c8148c4dae35?w=300&q=70&fit=crop',
  kurta: 'https://images.unsplash.com/photo-1610030469983-98e550d6193c?w=300&q=70&fit=crop',
  salwar: 'https://images.unsplash.com/photo-1583391733956-6c78276477e1?w=300&q=70&fit=crop',
  sweater: 'https://images.unsplash.com/photo-1580331451062-99ff652288d7?w=300&q=70&fit=crop',
  tracksuit: 'https://images.unsplash.com/photo-1519058082700-08a0b56da9b4?w=300&q=70&fit=crop',
  suit: 'https://images.unsplash.com/photo-1507679799987-c73779587ccf?w=300&q=70&fit=crop',
  sherwani: 'https://images.unsplash.com/photo-1617627143233-b9e2eec4b2ae?w=300&q=70&fit=crop',
  coat: 'https://images.unsplash.com/photo-1512327536842-5aa37d1ba3e3?w=300&q=70&fit=crop',
  saree: 'https://images.unsplash.com/photo-1583391733956-6c78276477e1?w=300&q=70&fit=crop',
  woolen: 'https://images.unsplash.com/photo-1580331451062-99ff652288d7?w=300&q=70&fit=crop',
  iron: 'https://images.unsplash.com/photo-1558769132-cb1aea458c5e?w=300&q=70&fit=crop',
  blanket: 'https://images.unsplash.com/photo-1600369671854-574e28bdb7a8?w=300&q=70&fit=crop',
  quilt: 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=300&q=70&fit=crop',
  pillow: 'https://images.unsplash.com/photo-1592789705501-f9ae4278a9c8?w=300&q=70&fit=crop',
  curtain: 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=300&q=70&fit=crop',
  lehenga: 'https://images.unsplash.com/photo-1583391733956-6c78276477e1?w=300&q=70&fit=crop',
  dupatta: 'https://images.unsplash.com/photo-1610030469983-98e550d6193c?w=300&q=70&fit=crop',
}

const cats = [
  {
    icon: '👕', title: 'Clothes Washing', shortTitle: 'Washing', badge: null,
    desc: 'Machine and hand wash for all types of everyday clothing using eco-friendly detergents.',
    img: 'https://images.unsplash.com/photo-1545173168-9f1947eebb7f?w=1200&q=80&fit=crop',
    items: [
      { name: 'T-Shirt / Half Sleeve Shirt', price: '30', img: IMGS.tshirt },
      { name: 'Full Sleeve Shirt', price: '35', img: IMGS.shirt },
      { name: 'Jeans / Denim Trousers', price: '50', img: IMGS.jeans },
      { name: 'Cotton Trousers', price: '45', img: IMGS.trousers },
      { name: 'Kurta (Cotton)', price: '40', img: IMGS.kurta },
      { name: 'Salwar Kameez Set', price: '60', img: IMGS.salwar },
      { name: 'Kurti (Simple)', price: '35', img: IMGS.kurta },
      { name: 'Sweater / Sweatshirt', price: '70', img: IMGS.sweater },
      { name: 'Track Suit (Set)', price: '80', img: IMGS.tracksuit },
    ]
  },
  {
    icon: '🥼', title: 'Dry Cleaning', shortTitle: 'Dry Cleaning', badge: 'Most Popular',
    desc: 'Professional dry cleaning for delicate, formal, and luxury garments requiring specialized solvents.',
    img: 'https://images.unsplash.com/photo-1489274495757-95c7c837b101?w=1200&q=80&fit=crop',
    items: [
      { name: 'Suit (2-Piece)', desc: 'Jacket + Trouser', price: '200', img: IMGS.suit },
      { name: 'Suit (3-Piece)', desc: 'Jacket + Trouser + Waistcoat', price: '270', img: IMGS.suit },
      { name: 'Sherwani', price: '350', img: IMGS.sherwani },
      { name: 'Coat / Blazer', price: '180', img: IMGS.coat },
      { name: 'Formal Trouser', price: '80', img: IMGS.trousers },
      { name: 'Saree (Plain Silk)', price: '200', img: IMGS.saree },
      { name: 'Salwar Kameez (Heavy Work)', price: '150', img: IMGS.salwar },
      { name: 'Woolen Sweater', price: '100', img: IMGS.woolen },
      { name: 'Woolen Jacket / Coat', price: '200', img: IMGS.woolen },
      { name: 'Overcoat', price: '250', img: IMGS.coat },
    ]
  },
  {
    icon: '🧺', title: 'Ironing & Pressing', shortTitle: 'Ironing', badge: null,
    desc: 'Steam and press ironing for that crisp, wrinkle-free finish — every single time.',
    img: 'https://images.unsplash.com/photo-1558769132-cb1aea458c5e?w=1200&q=80&fit=crop',
    items: [
      { name: 'Shirt / T-Shirt', price: '20', img: IMGS.shirt },
      { name: 'Trousers', price: '25', img: IMGS.trousers },
      { name: 'Saree', price: '30', img: IMGS.saree },
      { name: 'Kurta / Kurti', price: '20', img: IMGS.kurta },
      { name: 'Salwar Kameez Set', price: '35', img: IMGS.salwar },
      { name: 'Suit (Full)', price: '60', img: IMGS.suit },
      { name: 'Bundle of 10 pieces', price: '150', img: IMGS.iron },
      { name: 'Bundle of 20 pieces', price: '270', img: IMGS.iron },
    ]
  },
  {
    icon: '🛏️', title: 'Blankets, Quilts & Home Textiles', shortTitle: 'Home Textiles', badge: null,
    desc: 'Heavy-duty deep cleaning for all your home textiles regardless of size.',
    img: 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=1200&q=80&fit=crop',
    items: [
      { name: 'Single Blanket (Cotton)', price: '150', img: IMGS.blanket },
      { name: 'Double Blanket (Cotton)', price: '200', img: IMGS.blanket },
      { name: 'Woolen Blanket (Single)', price: '200', img: IMGS.woolen },
      { name: 'Woolen Blanket (Double)', price: '280', img: IMGS.woolen },
      { name: 'Quilt / Duvet (Single)', price: '250', img: IMGS.quilt },
      { name: 'Quilt / Duvet (Double)', price: '350', img: IMGS.quilt },
      { name: 'Comforter', price: '300', img: IMGS.quilt },
      { name: 'Pillow', price: '80', img: IMGS.pillow },
      { name: 'Bed Sheet (Single)', price: '80', img: IMGS.quilt },
      { name: 'Bed Sheet (Double)', price: '120', img: IMGS.quilt },
      { name: 'Curtains (Per Panel)', price: '100', img: IMGS.curtain },
    ]
  },
  {
    icon: '👰', title: 'Bridal & Wedding Outfit Care', shortTitle: 'Bridal', badge: 'Premium',
    desc: 'Specialized care for your precious wedding garments — handled with extraordinary attention.',
    img: 'https://images.unsplash.com/photo-1583391733956-6c78276477e1?w=1200&q=80&fit=crop',
    items: [
      { name: 'Lehenga (Full Set)', desc: 'Choli + Skirt + Dupatta', price: '800', img: IMGS.lehenga },
      { name: 'Heavy Bridal Lehenga', desc: 'Zari/Zardozi work', price: '1200', img: IMGS.lehenga },
      { name: 'Silk Saree (Heavy Work)', price: '500', img: IMGS.saree },
      { name: 'Banarasi Saree', price: '600', img: IMGS.saree },
      { name: 'Sherwani (Bridal)', price: '600', img: IMGS.sherwani },
      { name: 'Achkan', price: '450', img: IMGS.sherwani },
      { name: 'Anarkali Suit (Heavy)', price: '400', img: IMGS.salwar },
      { name: 'Dupatta (Heavy Embroidery)', price: '200', img: IMGS.dupatta },
    ]
  },
]

const addons = [
  { icon: '🎯', name: 'Stain Treatment', desc: 'Specialized treatment for tough, set-in stains.', price: '50+' },
  { icon: '🌸', name: 'Fabric Softening', desc: 'Premium softener for extra softness and comfort.', price: '30' },
  { icon: '🧴', name: 'Fabric Conditioner', desc: 'Long-lasting freshness and fragrance treatment.', price: '25' },
  { icon: '⚡', name: 'Express Service (24hr)', desc: '50% surcharge on base price.', price: '+50%' },
  { icon: '📦', name: 'Gift Packaging', desc: 'Special fold & premium box packaging.', price: '50' },
  { icon: '🛡️', name: 'Anti-Static Treatment', desc: 'Reduce static cling on synthetic fabrics.', price: '40' },
]
</script>

<style scoped>
:root {
  --void: #060911;
  --abyss: #0B1018;
  --slate: #111827;
  --panel: #1A2333;
  --panel2: #1E2A3D;
  --rim: rgba(255, 255, 255, 0.07);
  --rim2: rgba(232, 160, 32, 0.22);
  --gold: #E8A020;
  --gold-lt: #F5C842;
  --gold-dim: #7A4A00;
  --gold-glow: rgba(232, 160, 32, 0.18);
  --teal: #0EA5A0;
  --cream: #F2EDE4;
  --fog: rgba(242, 237, 228, 0.55);
  --mist: rgba(242, 237, 228, 0.28);
}

* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

.pg {
  background: var(--void);
  color: var(--cream);
  font-family: 'DM Sans', system-ui, sans-serif;
  min-height: 100vh;
}

.container {
  max-width: 1280px;
  margin: 0 auto;
  padding: 0 28px;
}

.section {
  padding: 80px 0;
}

.accent {
  color: var(--gold);
  font-style: normal;
}

/* HERO */
.page-hero {
  background: var(--abyss);
  position: relative;
  overflow: hidden;
  padding: 100px 0 90px;
  border-bottom: 1px solid var(--rim);
}

.ph-bg {
  position: absolute;
  inset: 0;
  pointer-events: none;
}

.ph-orb {
  position: absolute;
  border-radius: 50%;
}

.ph-orb-1 {
  width: 520px;
  height: 520px;
  top: -160px;
  right: -100px;
  background: radial-gradient(circle, rgba(232, 160, 32, .12) 0%, transparent 65%);
}

.ph-orb-2 {
  width: 320px;
  height: 320px;
  bottom: -100px;
  left: -80px;
  background: radial-gradient(circle, rgba(14, 165, 160, .08) 0%, transparent 65%);
}

.ph-grid {
  position: absolute;
  inset: 0;
  background-image: linear-gradient(rgba(255, 255, 255, .018) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255, 255, 255, .018) 1px, transparent 1px);
  background-size: 56px 56px;
}

.ph-body {
  position: relative;
  z-index: 1;
  max-width: 720px;
}

.ph-tag {
  display: inline-flex;
  align-items: center;
  font-size: 11px;
  font-weight: 700;
  letter-spacing: .1em;
  text-transform: uppercase;
  color: var(--gold);
  background: rgba(232, 160, 32, .1);
  border: 1px solid rgba(232, 160, 32, .25);
  padding: 6px 16px;
  border-radius: 50px;
  margin-bottom: 18px;
}

.breadcrumb {
  display: flex;
  align-items: center;
  gap: 6px;
  font-size: 12px;
  color: var(--fog);
  margin-bottom: 20px;
}

.breadcrumb a {
  color: var(--gold);
  text-decoration: none;
}

.breadcrumb svg {
  width: 13px;
  height: 13px;
}

.ph-body h1 {
  font-family: 'Cormorant Garamond', 'Playfair Display', serif;
  font-size: clamp(2.6rem, 5.5vw, 4.2rem);
  font-weight: 900;
  line-height: 1.08;
  margin-bottom: 16px;
}

.ph-body>p {
  color: var(--fog);
  font-size: 16.5px;
  line-height: 1.7;
  margin-bottom: 36px;
}

.hero-stats {
  display: flex;
  gap: 36px;
  flex-wrap: wrap;
}

.stat strong {
  display: block;
  font-size: 1.6rem;
  font-weight: 800;
  color: var(--gold-lt);
}

.stat span {
  font-size: 11px;
  color: var(--fog);
  letter-spacing: .06em;
  text-transform: uppercase;
}

.scroll-hint {
  position: absolute;
  bottom: 26px;
  left: 50%;
  transform: translateX(-50%);
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 6px;
  font-size: 11px;
  letter-spacing: .1em;
  text-transform: uppercase;
  color: var(--mist);
  animation: bob 2s ease-in-out infinite;
}

.scroll-hint svg {
  width: 16px;
  height: 16px;
}

@keyframes bob {

  0%,
  100% {
    transform: translateX(-50%) translateY(0);
  }

  50% {
    transform: translateX(-50%) translateY(6px);
  }
}

/* STICKY NAV */
.cat-nav-wrap {
  position: sticky;
  top: 0;
  z-index: 50;
  background: rgba(11, 16, 24, .9);
  backdrop-filter: blur(18px);
  border-bottom: 1px solid var(--rim);
}

.cat-nav {
  display: flex;
  overflow-x: auto;
  scrollbar-width: none;
  -webkit-overflow-scrolling: touch;
}

.cat-nav::-webkit-scrollbar {
  display: none;
}

.cat-nav-btn {
  display: flex;
  align-items: center;
  gap: 8px;
  background: none;
  border: none;
  border-bottom: 2px solid transparent;
  color: var(--fog);
  font-family: 'DM Sans', system-ui, sans-serif;
  font-size: 13px;
  font-weight: 500;
  padding: 15px 22px;
  cursor: pointer;
  white-space: nowrap;
  transition: all .2s;
}

.cat-nav-btn:hover {
  color: var(--cream);
  background: rgba(255, 255, 255, .04);
}

.cat-nav-btn.active {
  color: var(--gold);
  border-bottom-color: var(--gold);
}

.cn-ico {
  font-size: 16px;
}

.cn-label {
  font-weight: 600;
}

/* CATEGORY SECTION */
.cat-section {
  margin-bottom: 56px;
  border-radius: 24px;
  overflow: hidden;
  border: 1px solid var(--rim);
  background: var(--slate);
}

.cat-banner {
  position: relative;
  height: 260px;
  overflow: hidden;
}

.cat-banner-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
  transition: transform .5s ease;
}

.cat-section:hover .cat-banner-img {
  transform: scale(1.04);
}

.cat-banner-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(to right, rgba(6, 9, 17, .95) 0%, rgba(6, 9, 17, .65) 55%, rgba(6, 9, 17, .1) 100%);
  display: flex;
  align-items: flex-end;
  padding: 32px 36px;
}

.cat-banner-content {
  display: flex;
  align-items: flex-end;
  gap: 22px;
}

.cat-ico-lg {
  width: 68px;
  height: 68px;
  border-radius: 18px;
  flex-shrink: 0;
  background: linear-gradient(135deg, rgba(232, 160, 32, .2), rgba(14, 165, 160, .1));
  border: 1px solid rgba(232, 160, 32, .28);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 30px;
  backdrop-filter: blur(8px);
}

.cat-banner-content h2 {
  font-family: 'Cormorant Garamond', 'Playfair Display', serif;
  font-size: 1.9rem;
  font-weight: 800;
  margin-bottom: 7px;
  line-height: 1.1;
}

.cat-banner-content p {
  color: var(--fog);
  font-size: 13.5px;
  line-height: 1.55;
  max-width: 500px;
}

.cat-pill-banner {
  display: inline-block;
  background: linear-gradient(135deg, var(--gold), var(--gold-dim));
  color: #fff;
  font-size: 10px;
  font-weight: 700;
  letter-spacing: .08em;
  text-transform: uppercase;
  padding: 4px 13px;
  border-radius: 50px;
  margin-bottom: 9px;
}

/* PRICE GRID */
.price-grid-wrap {
  padding: 26px 30px 30px;
}

.item-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
  gap: 12px;
}

.item-card {
  background: var(--panel);
  border: 1px solid var(--rim);
  border-radius: 14px;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  transition: all .22s ease;
  cursor: default;
}

.item-card:hover {
  border-color: var(--rim2);
  transform: translateY(-4px);
  box-shadow: 0 14px 36px rgba(0, 0, 0, .45);
}

.item-thumb-wrap {
  height: 130px;
  overflow: hidden;
  flex-shrink: 0;
  background: var(--panel2);
}

.item-thumb {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
  transition: transform .4s ease;
}

.item-card:hover .item-thumb {
  transform: scale(1.08);
}

.item-body {
  padding: 14px;
  display: flex;
  flex-direction: column;
  gap: 4px;
  flex: 1;
}

.item-name {
  font-size: 13px;
  font-weight: 600;
  line-height: 1.35;
}

.item-sub {
  font-size: 11.5px;
  color: var(--fog);
}

.item-price-row {
  display: flex;
  align-items: baseline;
  gap: 6px;
  margin-top: auto;
  padding-top: 10px;
}

.item-price {
  font-size: 19px;
  font-weight: 800;
  color: var(--gold);
}

.item-unit {
  font-size: 10.5px;
  color: var(--mist);
}

/* ADD-ONS */
.addons-section {
  background: var(--slate);
  border: 1px solid var(--rim);
  border-radius: 24px;
  padding: 36px;
  margin-bottom: 20px;
}

.addons-header {
  margin-bottom: 26px;
}

.addons-header h3 {
  font-family: 'Cormorant Garamond', 'Playfair Display', serif;
  font-size: 1.55rem;
  font-weight: 800;
  margin-bottom: 6px;
}

.addons-header p {
  color: var(--fog);
  font-size: 13.5px;
}

.addons-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  gap: 12px;
}

.addon {
  display: flex;
  align-items: center;
  gap: 15px;
  background: var(--panel);
  border: 1px solid var(--rim);
  border-radius: 14px;
  padding: 17px;
  transition: all .2s;
}

.addon:hover {
  border-color: var(--rim2);
  background: rgba(232, 160, 32, .04);
}

.addon-ico-wrap {
  width: 50px;
  height: 50px;
  border-radius: 14px;
  flex-shrink: 0;
  background: linear-gradient(135deg, rgba(232, 160, 32, .13), rgba(14, 165, 160, .07));
  border: 1px solid rgba(232, 160, 32, .16);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 22px;
}

.addon-info {
  flex: 1;
}

.addon-info strong {
  display: block;
  font-size: 13.5px;
  font-weight: 600;
  margin-bottom: 3px;
}

.addon-info p {
  font-size: 12px;
  color: var(--fog);
}

.addon-price-wrap {
  text-align: right;
  flex-shrink: 0;
}

.addon-price {
  display: block;
  font-size: 17px;
  font-weight: 800;
  color: var(--gold);
}

.addon-per {
  display: block;
  font-size: 10px;
  color: var(--mist);
  margin-top: 2px;
}

/* NOTE */
.note {
  display: flex;
  gap: 16px;
  align-items: flex-start;
  background: rgba(232, 160, 32, .06);
  border: 1px solid rgba(232, 160, 32, .16);
  border-radius: 15px;
  padding: 22px;
}

.note-icon {
  font-size: 22px;
  flex-shrink: 0;
  margin-top: 2px;
}

.note h4 {
  font-weight: 700;
  font-size: 14.5px;
  margin-bottom: 5px;
}

.note p {
  color: var(--fog);
  font-size: 13.5px;
  line-height: 1.7;
}

.note a {
  color: var(--gold);
  text-decoration: none;
}

.note a:hover {
  text-decoration: underline;
}

/* HOW IT WORKS */
.process-strip {
  background: var(--abyss);
  border-top: 1px solid var(--rim);
  border-bottom: 1px solid var(--rim);
  padding: 72px 0;
}

.process-head {
  text-align: center;
  margin-bottom: 48px;
}

.process-head h3 {
  font-family: 'Cormorant Garamond', 'Playfair Display', serif;
  font-size: 1.75rem;
  font-weight: 800;
  margin-bottom: 8px;
}

.process-head p {
  color: var(--fog);
  font-size: 14px;
}

.steps {
  display: flex;
  align-items: flex-start;
  justify-content: center;
  flex-wrap: wrap;
}

.step {
  flex: 1;
  min-width: 150px;
  max-width: 220px;
  text-align: center;
  padding: 24px 16px;
  position: relative;
}

.step-num {
  font-size: 11px;
  font-weight: 700;
  letter-spacing: .12em;
  color: var(--gold);
  margin-bottom: 14px;
}

.step-icon {
  font-size: 2.1rem;
  margin-bottom: 12px;
}

.step-label {
  font-size: 14.5px;
  font-weight: 700;
  margin-bottom: 6px;
}

.step-desc {
  font-size: 12.5px;
  color: var(--fog);
  line-height: 1.5;
}

.step-arrow {
  position: absolute;
  right: -12px;
  top: 46%;
  font-size: 2rem;
  color: var(--gold-dim);
  line-height: 1;
}

/* BOTTOM CTA */
.bot-cta {
  position: relative;
  overflow: hidden;
  padding: 96px 0;
}

.cta-bg-img {
  position: absolute;
  inset: 0;
}

.cta-bg-img img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}

.cta-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(135deg, rgba(6, 9, 17, .97) 40%, rgba(6, 9, 17, .75) 100%);
}

.bot-cta-row {
  position: relative;
  z-index: 1;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 40px;
  flex-wrap: wrap;
}

.cta-eyebrow {
  font-size: 11px;
  font-weight: 700;
  letter-spacing: .12em;
  text-transform: uppercase;
  color: var(--gold);
  margin-bottom: 12px;
}

.cta-text h3 {
  font-family: 'Cormorant Garamond', 'Playfair Display', serif;
  font-size: clamp(1.7rem, 3.5vw, 2.5rem);
  font-weight: 900;
  line-height: 1.15;
  margin-bottom: 10px;
}

.cta-text p {
  color: var(--fog);
  font-size: 14px;
}

.cta-actions {
  display: flex;
  gap: 14px;
  align-items: center;
  flex-wrap: wrap;
}

.btn-gold {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  background: linear-gradient(135deg, var(--gold), var(--gold-dim));
  color: #fff;
  font-weight: 700;
  font-size: 14px;
  padding: 14px 28px;
  border-radius: 50px;
  text-decoration: none;
  white-space: nowrap;
  box-shadow: 0 6px 24px rgba(232, 160, 32, .4);
  transition: all .22s;
}

.btn-gold:hover {
  transform: translateY(-2px);
  box-shadow: 0 12px 32px rgba(232, 160, 32, .55);
}

.btn-gold svg {
  width: 15px;
  height: 15px;
}

.btn-ghost {
  display: inline-flex;
  align-items: center;
  border: 1px solid rgba(242, 237, 228, .2);
  color: var(--cream);
  font-weight: 600;
  font-size: 14px;
  padding: 14px 26px;
  border-radius: 50px;
  text-decoration: none;
  white-space: nowrap;
  transition: all .22s;
}

.btn-ghost:hover {
  border-color: var(--gold);
  color: var(--gold);
  background: rgba(232, 160, 32, .07);
}

/* RESPONSIVE */
@media(max-width: 900px) {
  .cat-banner {
    height: 210px;
  }

  .step-arrow {
    display: none;
  }
}

@media(max-width: 768px) {
  .section {
    padding: 48px 0;
  }

  .hero-stats {
    gap: 24px;
  }

  .item-grid {
    grid-template-columns: 1fr 1fr;
  }

  .price-grid-wrap {
    padding: 18px 18px 22px;
  }

  .cat-section {
    border-radius: 18px;
  }

  .cat-banner-content {
    flex-direction: column;
    align-items: flex-start;
    gap: 12px;
  }

  .bot-cta-row {
    flex-direction: column;
    text-align: center;
  }

  .cta-actions {
    justify-content: center;
  }

  .steps {
    flex-direction: column;
    align-items: center;
  }
}

@media(max-width: 480px) {
  .item-grid {
    grid-template-columns: 1fr;
  }

  .cat-banner-content h2 {
    font-size: 1.45rem;
  }
}
</style>
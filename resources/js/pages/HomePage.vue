<template>
  <div class="home" ref="homeRef" @mousemove="onMouseMove" @mouseleave="onMouseLeave">

    <!-- ══════════════════ CUSTOM CURSOR ══════════════════ -->
    <div class="cursor-ring" ref="cursorRing"></div>
    <div class="cursor-dot" ref="cursorDot"></div>
    <div class="cursor-trail" v-for="(t, i) in trails" :key="i" :ref="el => trailRefs[i] = el"></div>

    <!-- ══════════════════ FLOATING STICKERS (follow cursor) ══════════════════ -->
    <div class="sticker-field">
      <div v-for="(s, i) in stickers" :key="i" class="sticker" :class="{ 'sticker-active': s.active }"
        :ref="el => stickerEls[i] = el" :style="getStickerStyle(s, i)" @mouseenter="activateSticker(i)"
        @mouseleave="deactivateSticker(i)">
        <span class="sticker-inner">{{ s.e }}</span>
        <span class="sticker-shadow">{{ s.e }}</span>
      </div>
    </div>

    <!-- ══════════════════ HERO ══════════════════ -->
    <section class="hero">
      <div class="hero-stage">
        <div class="orb o1"></div>
        <div class="orb o2"></div>
        <div class="orb o3"></div>
        <canvas class="pcanvas" ref="canvasRef"></canvas>
        <div class="grid-veil"></div>
      </div>

      <div class="container hero-body">
        <div class="hero-chip" :class="{ in: vis }">
          <span class="chip-glow"></span>
          <span class="chip-dot"></span>
          <span>Premium Garment Care Since 2005</span>
          <span class="chip-star">✦</span>
        </div>

        <h1 class="hero-h1" :class="{ in: vis }">
          <span class="h-line l1">Your Clothes</span>
          <span class="h-line l2"><span>Deserve</span></span>
          <span class="h-line l3"><span class="ghost-text">The Best</span></span>
        </h1>

        <p class="hero-desc" :class="{ in: vis }">
          Expert dry cleaning, laundry, ironing, blanket care &amp; bridal outfit restoration — all under one trusted
          roof in Ludhiana.
        </p>

        <div class="hero-cta" :class="{ in: vis }">
          <router-link to="/booking" class="btn-gold magnetic" data-magnetic>
            <span class="magnetic-text">Book Free Pickup</span>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
              <path d="M5 12h14M12 5l7 7-7 7" />
            </svg>
          </router-link>
          <router-link to="/services" class="btn-ghost magnetic" data-magnetic>
            Explore Services
          </router-link>
        </div>

        <div class="hero-pills" :class="{ in: vis }">
          <div class="pill tilt-card" v-for="s in stats" :key="s.label" @mousemove="tiltCard" @mouseleave="resetTilt">
            <strong>{{ s.value }}</strong>
            <span>{{ s.label }}</span>
          </div>
        </div>
      </div>
    </section>

    <!-- ══════════════════ MARQUEE ══════════════════ -->
    <div class="marquee">
      <div class="marquee-track">
        <span v-for="n in 3" :key="n">
          <template v-for="item in marqueeItems" :key="item">
            <span class="mi">{{ item }}</span><span class="ms">✦</span>
          </template>
        </span>
      </div>
    </div>

    <!-- ══════════════════ SERVICES ══════════════════ -->
    <section class="section bg-abyss">
      <div class="container">
        <div class="sec-head" v-obs>
          <p class="sec-tag">What We Do </p>
          <h2>Complete <em class="accent">Garment Care</em> Solutions</h2>
          <p class="sec-sub">From everyday clothes to your most precious garments — handled with love and expertise.</p>
        </div>

        <div class="svc-grid">
          <div v-for="(s, i) in services" :key="s.title" class="svc-card tilt-card"
            :class="{ large: s.large, featured: s.featured }" v-obs :style="{ '--d': i * 0.07 + 's' }"
            @mousemove="tiltCard" @mouseleave="resetTilt">
            <div class="svc-inner-glow"></div>
            <div class="cursor-spotlight"></div>
            <div class="svc-icon">{{ s.icon }}</div>
            <div class="svc-content">
              <h3>{{ s.title }}</h3>
              <p>{{ s.desc }}</p>
              <div class="svc-tags">
                <span v-for="item in s.items" :key="item.name">
                  {{ item.name }} <strong>₹{{ item.price }}</strong>
                </span>
              </div>
            </div>
            <span class="svc-arrow">
              <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M4 10h12M10 4l6 6-6 6" />
              </svg>
            </span>
          </div>
        </div>

        <div class="sec-link" v-obs>
          <router-link to="/services" class="btn-outline magnetic" data-magnetic>
            View All Services &amp; Pricing
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M5 12h14M12 5l7 7-7 7" />
            </svg>
          </router-link>
        </div>
      </div>
    </section>

    <!-- ══════════════════ PROCESS ══════════════════ -->
    <section class="section bg-void">
      <div class="container">
        <div class="sec-head" v-obs>
          <p class="sec-tag">Simple &amp; Easy</p>
          <h2>How It <em class="accent">Works</em></h2>
          <p class="sec-sub">Four simple steps from scheduling to receiving your perfectly cleaned garments.</p>
        </div>

        <div class="proc-grid">
          <div v-for="(step, i) in steps" :key="step.title" class="proc-card tilt-card" v-obs
            :style="{ '--d': i * 0.1 + 's' }" @mousemove="tiltCard" @mouseleave="resetTilt">
            <div class="cursor-spotlight"></div>
            <div class="proc-num">0{{ i + 1 }}</div>
            <div class="proc-icon">{{ step.icon }}</div>
            <h4>{{ step.title }}</h4>
            <p>{{ step.desc }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- ══════════════════ WHY US ══════════════════ -->
    <section class="section bg-abyss">
      <div class="container why-layout">
        <div class="why-left" v-obs>
          <p class="sec-tag">Why Chauhan?</p>
          <h2>Trusted by <em class="accent">Thousands</em> in Punjab</h2>
          <p class="why-body">For over 18 years, we've been Ludhiana's go-to dry cleaners. Our trained professionals use
            the latest technology to care for your garments with the attention they deserve.</p>

          <div class="why-feats">
            <div class="wf tilt-card" v-for="f in features" :key="f.title" @mousemove="tiltCard"
              @mouseleave="resetTilt">
              <div class="wf-icon">{{ f.icon }}</div>
              <div>
                <h4>{{ f.title }}</h4>
                <p>{{ f.desc }}</p>
              </div>
            </div>
          </div>

          <router-link to="/about" class="btn-outline magnetic" style="margin-top:32px" data-magnetic>
            Learn More About Us
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M5 12h14M12 5l7 7-7 7" />
            </svg>
          </router-link>
        </div>

        <div class="why-right" v-obs>
          <div class="why-card tilt-card" @mousemove="tiltCard" @mouseleave="resetTilt">
            <div class="cursor-spotlight"></div>
            <div class="wc-shine"></div>
            <div class="wc-top">
              <span class="wc-icon">👰</span>
              <span class="wc-badge">Most Popular</span>
            </div>
            <h3>Bridal &amp; Wedding Outfit Care</h3>
            <p>Your wedding outfit is irreplaceable. We handle lehengas, sherwanis, sarees, and designer pieces with
              extraordinary care and attention.</p>
            <div class="wc-checks">
              <span>✓ Free Inspection</span>
              <span>✓ Stain Treatment</span>
              <span>✓ Expert Handling</span>
              <span>✓ Safe Packaging</span>
            </div>
          </div>
          <div class="fc-stat st1"><strong>18+</strong><span>Years of Trust</span></div>
          <div class="fc-stat st2"><strong>5K+</strong><span>Happy Customers</span></div>
          <div class="fc-stat st3">
            <div class="st-stars">★★★★★</div>
            <span>4.9 Rating</span>
          </div>
        </div>
      </div>
    </section>

    <!-- ══════════════════ TESTIMONIALS ══════════════════ -->
    <section class="section bg-void">
      <div class="container">
        <div class="sec-head" v-obs>
          <p class="sec-tag">Reviews</p>
          <h2>What Our <em class="accent">Customers Say</em></h2>
          <p class="sec-sub">Don't just take our word for it.</p>
        </div>

        <div class="testi-grid">
          <div v-for="(t, i) in testimonials" :key="t.name" class="testi-card tilt-card" v-obs
            :style="{ '--d': i * 0.08 + 's' }" @mousemove="tiltCard" @mouseleave="resetTilt">
            <div class="cursor-spotlight"></div>
            <div class="tq">"</div>
            <div class="t-stars">★★★★★</div>
            <p>{{ t.text }}</p>
            <div class="t-author">
              <div class="t-av">{{ t.name[0] }}</div>
              <div>
                <strong>{{ t.name }}</strong>
                <small>📍 {{ t.location }}</small>
              </div>
              <span class="t-tag">{{ t.service }}</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ══════════════════ CTA ══════════════════ -->
    <section class="cta-band" v-obs>
      <div class="cta-light"></div>
      <div class="cta-mesh"></div>
      <div class="container cta-row">
        <div class="cta-words">
          <h2>Ready for Freshly Clean Clothes?</h2>
          <p>Book your free pickup today. We collect, clean &amp; deliver right to your door.</p>
        </div>
        <div class="cta-btns">
          <router-link to="/booking" class="btn-gold magnetic" data-magnetic>
            <span>Schedule Free Pickup</span>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
              <path d="M5 12h14M12 5l7 7-7 7" />
            </svg>
          </router-link>
          <a href="tel:+918534837704" class="btn-ghost-teal magnetic" data-magnetic>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path
                d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 8.81 19.79 19.79 0 01.02 2.18 2 2 0 012 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.9z" />
            </svg>
            Call Now
          </a>
        </div>
      </div>
    </section>

  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted, reactive } from 'vue'

// ─── REFS ───
const homeRef = ref(null)
const canvasRef = ref(null)
const cursorRing = ref(null)
const cursorDot = ref(null)
const vis = ref(false)
const trailRefs = ref([])
const stickerEls = ref([])

// ─── CURSOR STATE ───
const mouse = { x: 0, y: 0 }
const ring = { x: 0, y: 0 }
const trails = Array.from({ length: 8 }, () => reactive({ x: 0, y: 0 }))
let trailPositions = Array.from({ length: 8 }, () => ({ x: 0, y: 0 }))
let rafId = null
let cursorEnlarged = false

// ─── STICKERS (floating emoji near cursor) ───
const stickers = reactive([
  { e: '👔', x: 120, y: 200, active: false, vx: 0.3, vy: 0.2 },
  { e: '✨', x: 300, y: 400, active: false, vx: -0.2, vy: 0.35 },
  { e: '👗', x: 500, y: 150, active: false, vx: 0.25, vy: -0.3 },
  { e: '🧺', x: 700, y: 350, active: false, vx: -0.35, vy: 0.2 },
  { e: '👰', x: 900, y: 180, active: false, vx: 0.2, vy: 0.4 },
  { e: '🥼', x: 1100, y: 420, active: false, vx: -0.3, vy: -0.25 },
  { e: '⭐', x: 200, y: 600, active: false, vx: 0.4, vy: -0.2 },
  { e: '🌿', x: 800, y: 550, active: false, vx: -0.2, vy: 0.3 },
])

// sticker target positions (float towards cursor with inertia)
const stickerTargets = stickers.map(s => ({ x: s.x, y: s.y }))

function getStickerStyle(s) {
  return {
    left: s.x + 'px',
    top: s.y + 'px',
  }
}

function activateSticker(i) { stickers[i].active = true }
function deactivateSticker(i) { stickers[i].active = false }

// ─── MOUSE MOVE ───
function onMouseMove(e) {
  mouse.x = e.clientX
  mouse.y = e.clientY

  // move cursor dot immediately
  if (cursorDot.value) {
    cursorDot.value.style.left = mouse.x + 'px'
    cursorDot.value.style.top = mouse.y + 'px'
  }

  // cursor spotlight on cards
  updateSpotlights(e)

  // magnetic buttons
  updateMagnetics(e)

  // sticker drift towards cursor
  stickerTargets.forEach((t, i) => {
    const dist = Math.hypot(mouse.x - stickers[i].x, mouse.y - stickers[i].y)
    if (dist < 260) {
      // gently pull toward cursor
      t.x += (mouse.x - stickers[i].x) * 0.0025
      t.y += (mouse.y - stickers[i].y) * 0.0025
    }
  })
}

function onMouseLeave() {
  if (cursorRing.value) cursorRing.value.style.opacity = '0'
  if (cursorDot.value) cursorDot.value.style.opacity = '0'
}

// ─── ANIMATION LOOP ───
function animLoop() {
  // smooth ring follow
  ring.x += (mouse.x - ring.x) * 0.12
  ring.y += (mouse.y - ring.y) * 0.12
  if (cursorRing.value) {
    cursorRing.value.style.left = ring.x + 'px'
    cursorRing.value.style.top = ring.y + 'px'
    cursorRing.value.style.opacity = '1'
  }
  if (cursorDot.value) cursorDot.value.style.opacity = '1'

  // trail positions — each follows the previous with delay
  trailPositions[0].x += (mouse.x - trailPositions[0].x) * 0.22
  trailPositions[0].y += (mouse.y - trailPositions[0].y) * 0.22
  for (let i = 1; i < trails.length; i++) {
    trailPositions[i].x += (trailPositions[i - 1].x - trailPositions[i].x) * 0.22
    trailPositions[i].y += (trailPositions[i - 1].y - trailPositions[i].y) * 0.22
  }
  trailRefs.value.forEach((el, i) => {
    if (!el) return
    const p = trailPositions[i]
    const scale = 1 - i * 0.1
    const opacity = (1 - i / trails.length) * 0.35
    el.style.left = p.x + 'px'
    el.style.top = p.y + 'px'
    el.style.opacity = opacity
    el.style.transform = `translate(-50%,-50%) scale(${scale})`
  })

  // animate stickers with gentle bounce/float
  const now = Date.now() / 1000
  stickers.forEach((s, i) => {
    // autonomous float
    s.x += s.vx + Math.sin(now * 0.4 + i) * 0.15
    s.y += s.vy + Math.cos(now * 0.3 + i * 0.7) * 0.15

    // drift towards sticker target (cursor pull)
    s.x += (stickerTargets[i].x - s.x) * 0.02
    s.y += (stickerTargets[i].y - s.y) * 0.02

    // reset target to current (so pull only happens near cursor)
    stickerTargets[i].x = s.x
    stickerTargets[i].y = s.y

    // bounce off screen edges
    const W = window.innerWidth, H = document.documentElement.scrollHeight
    if (s.x < 60 || s.x > W - 60) { s.vx *= -1; s.x = Math.max(60, Math.min(W - 60, s.x)) }
    if (s.y < 60 || s.y > H - 60) { s.vy *= -1; s.y = Math.max(60, Math.min(H - 60, s.y)) }

    if (stickerEls.value[i]) {
      stickerEls.value[i].style.left = s.x + 'px'
      stickerEls.value[i].style.top = s.y + 'px'
    }
  })

  rafId = requestAnimationFrame(animLoop)
}

// ─── CARD TILT ───
function tiltCard(e) {
  const card = e.currentTarget
  const rect = card.getBoundingClientRect()
  const cx = rect.left + rect.width / 2
  const cy = rect.top + rect.height / 2
  const dx = (e.clientX - cx) / (rect.width / 2)
  const dy = (e.clientY - cy) / (rect.height / 2)
  card.style.transform = `perspective(800px) rotateY(${dx * 9}deg) rotateX(${-dy * 9}deg) translateZ(8px)`
  card.style.transition = 'transform 0.05s linear'

  // move spotlight
  const spot = card.querySelector('.cursor-spotlight')
  if (spot) {
    spot.style.left = `${e.clientX - rect.left}px`
    spot.style.top = `${e.clientY - rect.top}px`
    spot.style.opacity = '1'
  }
}

function resetTilt(e) {
  const card = e.currentTarget
  card.style.transform = 'perspective(800px) rotateY(0deg) rotateX(0deg) translateZ(0)'
  card.style.transition = 'transform 0.55s cubic-bezier(.03,.98,.52,.99)'
  const spot = card.querySelector('.cursor-spotlight')
  if (spot) spot.style.opacity = '0'
}

// ─── SPOTLIGHT ───
function updateSpotlights(e) {
  document.querySelectorAll('.cursor-spotlight').forEach(spot => {
    const card = spot.parentElement
    const rect = card.getBoundingClientRect()
    if (
      e.clientX >= rect.left && e.clientX <= rect.right &&
      e.clientY >= rect.top && e.clientY <= rect.bottom
    ) {
      spot.style.left = `${e.clientX - rect.left}px`
      spot.style.top = `${e.clientY - rect.top}px`
    }
  })
}

// ─── MAGNETIC BUTTONS ───
function updateMagnetics(e) {
  document.querySelectorAll('[data-magnetic]').forEach(btn => {
    const rect = btn.getBoundingClientRect()
    const cx = rect.left + rect.width / 2
    const cy = rect.top + rect.height / 2
    const dist = Math.hypot(e.clientX - cx, e.clientY - cy)
    const range = 90

    if (dist < range) {
      const pull = (1 - dist / range) * 0.45
      const dx = (e.clientX - cx) * pull
      const dy = (e.clientY - cy) * pull
      btn.style.transform = `translate(${dx}px, ${dy}px) scale(1.06)`
      btn.style.transition = 'transform 0.12s ease'
      // enlarge cursor ring
      if (!cursorEnlarged && cursorRing.value) {
        cursorRing.value.style.width = '64px'
        cursorRing.value.style.height = '64px'
        cursorRing.value.style.borderColor = 'rgba(232,160,32,0.8)'
        cursorRing.value.style.mixBlendMode = 'normal'
        cursorEnlarged = true
      }
    } else {
      btn.style.transform = 'translate(0,0) scale(1)'
      btn.style.transition = 'transform 0.45s cubic-bezier(.03,.98,.52,.99)'
      if (cursorEnlarged && cursorRing.value) {
        cursorRing.value.style.width = '38px'
        cursorRing.value.style.height = '38px'
        cursorRing.value.style.borderColor = 'rgba(232,160,32,0.55)'
        cursorEnlarged = false
      }
    }
  })
}

// ─── PARTICLES ───
function initParticles() {
  const cv = canvasRef.value
  if (!cv) return
  const ctx = cv.getContext('2d')
  cv.width = window.innerWidth
  cv.height = window.innerHeight
  const pts = Array.from({ length: 55 }, () => ({
    x: Math.random() * cv.width,
    y: Math.random() * cv.height,
    r: Math.random() * 1.2 + 0.3,
    dx: (Math.random() - .5) * .25,
    dy: (Math.random() - .5) * .25,
    o: Math.random() * .3 + .05,
  }))
  function draw() {
    ctx.clearRect(0, 0, cv.width, cv.height)
    pts.forEach(p => {
      ctx.beginPath()
      ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2)
      ctx.fillStyle = `rgba(232,160,32,${p.o})`
      ctx.fill()
      p.x += p.dx; p.y += p.dy
      if (p.x < 0 || p.x > cv.width) p.dx *= -1
      if (p.y < 0 || p.y > cv.height) p.dy *= -1
    })
    requestAnimationFrame(draw)
  }
  draw()
  window.addEventListener('resize', () => { cv.width = window.innerWidth; cv.height = window.innerHeight })
}

// ─── INTERSECTION OBSERVER DIRECTIVE ───
const vObs = {
  mounted(el) {
    const d = el.style.getPropertyValue('--d') || '0s'
    el.style.cssText += `opacity:0;transform:translateY(26px);transition:opacity .65s ease ${d},transform .65s ease ${d};`
    const io = new IntersectionObserver(([e]) => {
      if (e.isIntersecting) { el.style.opacity = '1'; el.style.transform = 'translateY(0)'; io.disconnect() }
    }, { threshold: 0.1 })
    io.observe(el)
  }
}

// ─── LIFECYCLE ───
onMounted(() => {
  setTimeout(() => { vis.value = true }, 80)
  initParticles()
  animLoop()
})

onUnmounted(() => {
  if (rafId) cancelAnimationFrame(rafId)
})

// ─── DATA ───
const stats = [
  { value: '18+', label: 'Years' },
  { value: '5K+', label: 'Customers' },
  { value: '99%', label: 'Satisfaction' },
  { value: '24hr', label: 'Express' },
]

const marqueeItems = [
  'Dry Cleaning', 'Clothes Washing', 'Ironing & Pressing', 'Blanket Care',
  'Wedding Outfits', 'Stain Treatment', 'Free Home Pickup', 'Express 24hr',
]

const services = [
  {
    icon: '👕', title: 'Clothes Washing',
    desc: 'Machine and hand wash for everyday clothing with eco-friendly detergents.',
    items: [{ name: 'Shirt', price: '30' }, { name: 'Jeans', price: '50' }],
    large: false, featured: false,
  },
  {
    icon: '🥼', title: 'Dry Cleaning',
    desc: 'Professional dry cleaning for delicate, formal, and luxury garments requiring specialized care.',
    items: [{ name: 'Suit', price: '200' }, { name: 'Blazer', price: '180' }, { name: 'Sherwani', price: '350' }],
    large: true, featured: true,
  },
  {
    icon: '🧺', title: 'Ironing & Pressing',
    desc: 'Steam ironing for a crisp, wrinkle-free professional finish.',
    items: [{ name: 'Shirt', price: '20' }, { name: 'Bundle 10', price: '150' }],
    large: false, featured: false,
  },
  {
    icon: '🛏️', title: 'Blankets & Quilts',
    desc: 'Heavy-duty deep cleaning for all sizes of home textiles.',
    items: [{ name: 'Single', price: '150' }, { name: 'Double', price: '200' }],
    large: false, featured: false,
  },
  {
    icon: '👰', title: 'Wedding Outfit Care',
    desc: 'Specialized care for lehengas, sarees, sherwanis — handled like precious heirlooms.',
    items: [{ name: 'Lehenga', price: '800' }, { name: 'Saree', price: '500' }, { name: 'Sherwani', price: '600' }],
    large: true, featured: false,
  },
  {
    icon: '⚡', title: 'Express Service',
    desc: '24-hour turnaround for urgent needs. Your garments, fast.',
    items: [{ name: 'Express', price: '+50%' }],
    large: false, featured: false,
  },
]

const steps = [
  { icon: '📲', title: 'Book Online', desc: 'Fill the form or call us to schedule your free pickup at your convenience.' },
  { icon: '🚗', title: 'Free Pickup', desc: 'We collect your garments directly from your doorstep — no effort needed.' },
  { icon: '✨', title: 'Expert Cleaning', desc: 'Professionally cleaned, pressed, and carefully packaged by our experts.' },
  { icon: '📦', title: 'Home Delivery', desc: 'Delivered back fresh, clean, and ready to wear right to your door.' },
]

const features = [
  { icon: '🚗', title: 'Free Home Pickup & Delivery', desc: 'Schedule at your convenience — we come to you anywhere in Ludhiana.' },
  { icon: '⚡', title: '24-Hour Express Service', desc: 'Need it urgently? Our express turnaround delivers within 24 hours.' },
  { icon: '🌿', title: 'Eco-Friendly Cleaning', desc: 'Safe biodegradable solvents gentle on fabrics and the planet.' },
  { icon: '🔒', title: '100% Satisfaction Guarantee', desc: "Not happy? We'll redo it free — no questions asked." },
]

const testimonials = [
  { name: 'Priya Sharma', location: 'Ludhiana', text: 'They cleaned my wedding lehenga beautifully. Every bead and embroidery was preserved perfectly. Absolutely brand new!', service: 'Wedding Care' },
  { name: 'Rajesh Kumar', location: 'Jalandhar', text: 'Best dry cleaners in the area. Very professional, timely delivery, and always perfectly pressed.', service: 'Dry Cleaning' },
  { name: 'Anita Singh', location: 'Ludhiana', text: 'Love the home pickup and delivery service. My go-to for all dry cleaning needs for the past 3 years.', service: 'Regular Wash' },
  { name: 'Harpreet Kaur', location: 'Ludhiana', text: 'Sent my heavy blankets — came back incredibly clean. Express service is a lifesaver for last-minute needs.', service: 'Blankets' },
  { name: 'Vikram Malhotra', location: 'Chandigarh', text: 'Trusted Chauhan for my sherwani before my wedding. Absolutely flawless. Worth every rupee.', service: 'Dry Cleaning' },
  { name: 'Simran Dhaliwal', location: 'Ludhiana', text: 'Affordable, reliable and quick. The staff is very courteous. Five stars without hesitation!', service: 'Ironing' },
]
</script>

<style scoped>
/* ─── TOKENS ─── */
:root {
  --void: #060911;
  --abyss: #0B1018;
  --slate: #111827;
  --panel: #1A2333;
  --rim: rgba(255, 255, 255, 0.07);
  --rim2: rgba(232, 160, 32, 0.18);
  --gold: #E8A020;
  --gold-lt: #F5C842;
  --gold-dim: #7A4A00;
  --gold-glow: rgba(232, 160, 32, 0.14);
  --teal: #0EA5A0;
  --teal-lt: #2DD4BF;
  --cream: #F2EDE4;
  --fog: rgba(242, 237, 228, 0.50);
  --mist: rgba(242, 237, 228, 0.28);
}

* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

/* ─── CUSTOM CURSOR ─── */
.home {
  cursor: none;
}

.cursor-ring {
  position: fixed;
  width: 38px;
  height: 38px;
  border: 1.5px solid rgba(232, 160, 32, 0.55);
  border-radius: 50%;
  pointer-events: none;
  z-index: 9999;
  transform: translate(-50%, -50%);
  transition: width 0.25s ease, height 0.25s ease, border-color 0.25s ease, opacity 0.3s ease;
  mix-blend-mode: difference;
  will-change: left, top;
}

.cursor-dot {
  position: fixed;
  width: 7px;
  height: 7px;
  background: var(--gold);
  border-radius: 50%;
  pointer-events: none;
  z-index: 10000;
  transform: translate(-50%, -50%);
  box-shadow: 0 0 10px rgba(232, 160, 32, 0.9);
  transition: opacity 0.3s ease;
  will-change: left, top;
}

.cursor-trail {
  position: fixed;
  width: 8px;
  height: 8px;
  background: var(--gold-lt);
  border-radius: 50%;
  pointer-events: none;
  z-index: 9998;
  will-change: left, top, opacity;
}

/* ─── FLOATING STICKERS ─── */
.sticker-field {
  position: fixed;
  inset: 0;
  pointer-events: none;
  z-index: 5;
  overflow: hidden;
}

.sticker {
  position: absolute;
  pointer-events: auto;
  user-select: none;
  will-change: left, top;
}

.sticker-inner {
  display: block;
  font-size: 30px;
  line-height: 1;
  filter: drop-shadow(0 4px 12px rgba(232, 160, 32, 0.3));
  transition: transform 0.3s cubic-bezier(.34, 1.56, .64, 1), filter 0.3s ease;
  cursor: none;
  animation: stickerFloat 6s ease-in-out infinite;
}

.sticker-shadow {
  position: absolute;
  top: 8px;
  left: 2px;
  font-size: 30px;
  line-height: 1;
  opacity: 0.15;
  filter: blur(6px);
  transform: scaleX(0.9);
}

.sticker:hover .sticker-inner,
.sticker-active .sticker-inner {
  transform: scale(1.5) rotate(15deg);
  filter: drop-shadow(0 8px 24px rgba(232, 160, 32, 0.65));
  animation-play-state: paused;
}

@keyframes stickerFloat {

  0%,
  100% {
    transform: translateY(0) rotate(-3deg);
  }

  33% {
    transform: translateY(-9px) rotate(4deg);
  }

  66% {
    transform: translateY(-4px) rotate(-6deg);
  }
}

/* ─── CURSOR SPOTLIGHT ON CARDS ─── */
.cursor-spotlight {
  position: absolute;
  width: 200px;
  height: 200px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(232, 160, 32, 0.1) 0%, transparent 65%);
  pointer-events: none;
  transform: translate(-50%, -50%);
  opacity: 0;
  transition: opacity 0.3s ease;
  z-index: 0;
  will-change: left, top;
}

/* ─── TILT CARDS ─── */
.tilt-card {
  transform-style: preserve-3d;
  will-change: transform;
}

.home {
  background: var(--void);
  color: var(--cream);
  font-family: 'DM Sans', system-ui, sans-serif;
}

.container {
  max-width: 1240px;
  margin: 0 auto;
  padding: 0 28px;
}

.section {
  padding: 108px 0;
}

.bg-void {
  background: var(--void);
}

.bg-abyss {
  background: var(--abyss);
}

/* ─── TYPOGRAPHY ─── */
.sec-tag {
  font-size: 10.5px;
  font-weight: 700;
  letter-spacing: .22em;
  text-transform: uppercase;
  color: var(--gold);
  display: flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 14px;
}

.sec-tag::before,
.sec-tag::after {
  content: '';
  width: 28px;
  height: 1px;
  background: var(--gold);
  opacity: .45;
}

.sec-head {
  text-align: center;
  margin-bottom: 72px;
}

.sec-head h2 {
  font-family: 'Cormorant Garamond', 'Playfair Display', serif;
  font-size: clamp(2rem, 4vw, 3.2rem);
  font-weight: 800;
  line-height: 1.1;
  margin-bottom: 16px;
}

.sec-sub {
  color: var(--fog);
  font-size: 15px;
  max-width: 500px;
  margin: 0 auto;
  line-height: 1.8;
}

.accent {
  color: var(--gold);
  font-style: normal;
}

/* ─── BUTTONS ─── */
.btn-gold {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  background: linear-gradient(135deg, var(--gold), var(--gold-dim));
  color: #fff;
  font-weight: 700;
  font-size: 15px;
  padding: 14px 28px;
  border-radius: 50px;
  text-decoration: none;
  box-shadow: 0 6px 22px rgba(232, 160, 32, .4), inset 0 1px 0 rgba(255, 255, 255, .15);
  transition: box-shadow .25s, background .25s;
  position: relative;
  overflow: hidden;
  white-space: nowrap;
  cursor: none;
}

.btn-gold::before {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(135deg, rgba(255, 255, 255, .15), transparent);
  opacity: 0;
  transition: opacity .2s;
}

.btn-gold:hover::before {
  opacity: 1;
}

.btn-gold:hover {
  box-shadow: 0 12px 32px rgba(232, 160, 32, .55);
}

.btn-gold svg {
  width: 17px;
  height: 17px;
}

.btn-ghost {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  border: 1px solid rgba(242, 237, 228, .12);
  color: var(--cream);
  font-weight: 500;
  font-size: 15px;
  padding: 14px 26px;
  border-radius: 50px;
  text-decoration: none;
  transition: all .2s;
  cursor: none;
}

.btn-ghost:hover {
  border-color: var(--gold);
  color: var(--gold-lt);
  background: var(--gold-glow);
}

.btn-ghost-teal {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  border: 1px solid rgba(14, 165, 160, .3);
  color: var(--teal-lt);
  font-weight: 500;
  font-size: 15px;
  padding: 14px 26px;
  border-radius: 50px;
  text-decoration: none;
  transition: all .2s;
  backdrop-filter: blur(8px);
  cursor: none;
}

.btn-ghost-teal:hover {
  background: rgba(14, 165, 160, .1);
  border-color: var(--teal-lt);
}

.btn-ghost-teal svg {
  width: 16px;
  height: 16px;
}

.btn-outline {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  border: 1px solid var(--rim2);
  color: var(--gold-lt);
  font-weight: 600;
  font-size: 13.5px;
  padding: 12px 24px;
  border-radius: 50px;
  text-decoration: none;
  transition: all .2s;
  background: var(--gold-glow);
  cursor: none;
}

.btn-outline:hover {
  background: rgba(232, 160, 32, .2);
  border-color: var(--gold);
}

.btn-outline svg {
  width: 15px;
  height: 15px;
}

/* ─── MAGNETIC PULSE ─── */
.magnetic {
  position: relative;
}

.magnetic::after {
  content: '';
  position: absolute;
  inset: -8px;
  border-radius: 50px;
  border: 1px solid rgba(232, 160, 32, 0);
  transition: all 0.35s ease;
}

.magnetic:hover::after {
  inset: -14px;
  border-color: rgba(232, 160, 32, 0.3);
  animation: magneticPulse 1.2s ease infinite;
}

@keyframes magneticPulse {

  0%,
  100% {
    box-shadow: 0 0 0 0 rgba(232, 160, 32, 0.2);
  }

  50% {
    box-shadow: 0 0 0 10px rgba(232, 160, 32, 0);
  }
}

/* ─── HERO ─── */
.hero {
  min-height: 100vh;
  display: flex;
  align-items: center;
  position: relative;
  overflow: hidden;
  background: var(--void);
}

.hero-stage {
  position: absolute;
  inset: 0;
}

.orb {
  position: absolute;
  border-radius: 50%;
  filter: blur(90px);
  pointer-events: none;
}

.o1 {
  width: 640px;
  height: 640px;
  background: radial-gradient(circle, rgba(232, 160, 32, .14) 0%, transparent 65%);
  top: -160px;
  left: 50%;
  transform: translateX(-50%);
  animation: opulse1 7s ease-in-out infinite;
}

.o2 {
  width: 420px;
  height: 420px;
  background: radial-gradient(circle, rgba(14, 165, 160, .08) 0%, transparent 65%);
  bottom: 80px;
  right: -100px;
  animation: opulse 9s ease-in-out infinite 2s;
}

.o3 {
  width: 280px;
  height: 280px;
  background: radial-gradient(circle, rgba(232, 160, 32, .06) 0%, transparent 65%);
  top: 55%;
  left: -60px;
  animation: opulse 7.5s ease-in-out infinite 4s;
}

@keyframes opulse {

  0%,
  100% {
    opacity: .7;
    transform: scale(1)
  }

  50% {
    opacity: 1;
    transform: scale(1.1)
  }
}

@keyframes opulse1 {

  0%,
  100% {
    opacity: .7;
    transform: translateX(-50%) scale(1)
  }

  50% {
    opacity: 1;
    transform: translateX(-50%) scale(1.1)
  }
}

.pcanvas {
  position: absolute;
  inset: 0;
}

.grid-veil {
  position: absolute;
  inset: 0;
  background-image: linear-gradient(rgba(255, 255, 255, .016) 1px, transparent 1px), linear-gradient(90deg, rgba(255, 255, 255, .016) 1px, transparent 1px);
  background-size: 72px 72px;
}

.hero-body {
  position: relative;
  z-index: 2;
  max-width: 800px;
  padding: 100px 28px 80px;
}

.hero-chip {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  background: rgba(232, 160, 32, .09);
  border: 1px solid rgba(232, 160, 32, .2);
  border-radius: 50px;
  padding: 9px 18px;
  margin-bottom: 32px;
  font-size: 13px;
  font-weight: 500;
  color: var(--cream);
  opacity: 0;
  transform: translateY(18px);
  transition: opacity .7s, transform .7s;
}

.hero-chip.in {
  opacity: 1;
  transform: translateY(0);
}

.chip-glow {
  position: absolute;
  width: 60px;
  height: 60px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(232, 160, 32, .4), transparent);
  pointer-events: none;
  margin-left: -8px;
}

.chip-dot {
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: var(--gold);
  box-shadow: 0 0 8px rgba(232, 160, 32, .9);
  animation: cdot 1.6s ease infinite;
  flex-shrink: 0;
}

@keyframes cdot {

  0%,
  100% {
    opacity: 1
  }

  50% {
    opacity: .25
  }
}

.chip-star {
  color: var(--gold-lt);
  font-size: 13px;
}

.hero-h1 {
  font-family: 'Cormorant Garamond', 'Playfair Display', serif;
  font-weight: 900;
  display: flex;
  flex-direction: column;
  margin-bottom: 26px;
}

.h-line {
  display: block;
  font-size: clamp(3.2rem, 7.5vw, 6.2rem);
  line-height: 1.0;
  opacity: 0;
  transform: translateY(36px);
  transition: opacity .8s ease, transform .8s ease;
}

.hero-h1.in .h-line {
  opacity: 1;
  transform: translateY(0);
}

.hero-h1.in .l1 {
  transition-delay: .08s;
}

.hero-h1.in .l2 {
  transition-delay: .22s;
}

.hero-h1.in .l3 {
  transition-delay: .38s;
}

.shimmer-text {
  background: linear-gradient(135deg, var(--gold) 0%, var(--gold-lt) 40%, var(--gold) 80%);
  background-size: 200%;
  background-clip: text;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  animation: shimmer 3s linear infinite;
}

@keyframes shimmer {
  0% {
    background-position: 0%
  }

  100% {
    background-position: 200%
  }
}

.ghost-text {
  -webkit-text-stroke: 2px rgba(242, 237, 228, .18);
  -webkit-text-fill-color: transparent;
  color: transparent;
}

.hero-desc {
  color: var(--fog);
  font-size: 17px;
  line-height: 1.8;
  margin-bottom: 38px;
  max-width: 580px;
  opacity: 0;
  transform: translateY(18px);
  transition: opacity .7s ease .5s, transform .7s ease .5s;
}

.hero-desc.in {
  opacity: 1;
  transform: translateY(0);
}

.hero-cta {
  display: flex;
  gap: 14px;
  flex-wrap: wrap;
  margin-bottom: 52px;
  opacity: 0;
  transform: translateY(18px);
  transition: opacity .7s ease .65s, transform .7s ease .65s;
}

.hero-cta.in {
  opacity: 1;
  transform: translateY(0);
}

.hero-pills {
  display: flex;
  gap: 8px;
  flex-wrap: wrap;
  opacity: 0;
  transform: translateY(18px);
  transition: opacity .7s ease .82s, transform .7s ease .82s;
}

.hero-pills.in {
  opacity: 1;
  transform: translateY(0);
}

.pill {
  display: flex;
  align-items: center;
  gap: 10px;
  background: rgba(255, 255, 255, .03);
  border: 1px solid var(--rim);
  border-radius: 50px;
  padding: 9px 18px;
  transition: all .2s;
  cursor: none;
}

.pill:hover {
  border-color: rgba(232, 160, 32, .25);
  background: var(--gold-glow);
}

.pill strong {
  font-family: 'Cormorant Garamond', 'Playfair Display', serif;
  font-size: 1.45rem;
  font-weight: 800;
  color: var(--gold);
}

.pill span {
  font-size: 11.5px;
  color: var(--fog);
  text-transform: uppercase;
  letter-spacing: .08em;
}

/* ─── MARQUEE ─── */
.marquee {
  background: linear-gradient(135deg, var(--gold), var(--gold-dim));
  overflow: hidden;
  padding: 13px 0;
}

.marquee-track {
  display: flex;
  white-space: nowrap;
  animation: mscroll 28s linear infinite;
}

@keyframes mscroll {
  0% {
    transform: translateX(0)
  }

  100% {
    transform: translateX(-33.333%)
  }
}

.mi {
  font-size: 12.5px;
  font-weight: 600;
  color: rgba(255, 255, 255, .9);
  padding: 0 18px;
  letter-spacing: .05em;
}

.ms {
  color: rgba(255, 255, 255, .4);
  font-size: 9px;
}

/* ─── SERVICES ─── */
.svc-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 18px;
}

.svc-card {
  background: var(--slate);
  border: 1px solid var(--rim);
  border-radius: 20px;
  padding: 30px;
  position: relative;
  overflow: hidden;
  transition: border-color .3s, box-shadow .3s;
  cursor: none;
}

.svc-card:hover {
  border-color: var(--rim2);
  box-shadow: 0 20px 50px rgba(0, 0, 0, .5);
}

.svc-card.large {
  grid-column: span 2;
}

.svc-card.featured {
  border-color: rgba(232, 160, 32, .18);
}

.svc-card.featured::before {
  content: 'Popular';
  position: absolute;
  top: 14px;
  right: 14px;
  background: linear-gradient(135deg, var(--gold), var(--gold-dim));
  color: #fff;
  font-size: 10px;
  font-weight: 700;
  padding: 4px 11px;
  border-radius: 50px;
  letter-spacing: .08em;
}

.svc-inner-glow {
  position: absolute;
  inset: 0;
  background: radial-gradient(circle at 50% -20%, rgba(232, 160, 32, .07), transparent 60%);
  opacity: 0;
  transition: opacity .3s;
  pointer-events: none;
}

.svc-card:hover .svc-inner-glow {
  opacity: 1;
}

.svc-icon {
  font-size: 38px;
  margin-bottom: 16px;
  display: block;
  transition: transform .3s;
  position: relative;
  z-index: 1;
}

.svc-card:hover .svc-icon {
  transform: scale(1.15) rotate(-6deg);
}

.svc-content {
  position: relative;
  z-index: 1;
}

.svc-content h3 {
  font-family: 'Cormorant Garamond', 'Playfair Display', serif;
  font-size: 1.2rem;
  font-weight: 700;
  margin-bottom: 9px;
}

.svc-content p {
  color: var(--fog);
  font-size: 13.5px;
  line-height: 1.65;
  margin-bottom: 16px;
}

.svc-tags {
  display: flex;
  flex-wrap: wrap;
  gap: 7px;
}

.svc-tags span {
  font-size: 11.5px;
  color: var(--fog);
  background: rgba(255, 255, 255, .04);
  border: 1px solid var(--rim);
  padding: 4px 11px;
  border-radius: 50px;
}

.svc-tags span strong {
  color: var(--gold);
  font-weight: 600;
  margin-left: 4px;
}

.svc-arrow {
  position: absolute;
  bottom: 22px;
  right: 22px;
  width: 34px;
  height: 34px;
  border-radius: 50%;
  border: 1px solid var(--rim);
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--fog);
  transition: all .2s;
  z-index: 1;
}

.svc-arrow svg {
  width: 15px;
  height: 15px;
}

.svc-card:hover .svc-arrow {
  background: var(--gold);
  border-color: var(--gold);
  color: #fff;
  transform: rotate(-45deg);
}

.sec-link {
  text-align: center;
  margin-top: 48px;
}

/* ─── PROCESS ─── */
.proc-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 20px;
}

.proc-card {
  background: var(--slate);
  border: 1px solid var(--rim);
  border-radius: 20px;
  padding: 30px 24px;
  text-align: center;
  position: relative;
  transition: border-color .3s, box-shadow .3s;
  cursor: none;
}

.proc-card:hover {
  border-color: var(--rim2);
  box-shadow: 0 18px 44px rgba(0, 0, 0, .4);
}

.proc-num {
  position: absolute;
  top: 14px;
  right: 18px;
  font-family: 'Cormorant Garamond', 'Playfair Display', serif;
  font-size: 3rem;
  font-weight: 900;
  color: rgba(232, 160, 32, .06);
  line-height: 1;
}

.proc-icon {
  font-size: 34px;
  width: 62px;
  height: 62px;
  border-radius: 17px;
  background: linear-gradient(135deg, rgba(232, 160, 32, .12), rgba(14, 165, 160, .07));
  border: 1px solid rgba(232, 160, 32, .18);
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 16px;
  transition: transform .3s;
  position: relative;
  z-index: 1;
}

.proc-card:hover .proc-icon {
  transform: scale(1.1) rotate(-5deg);
}

.proc-card h4 {
  font-family: 'Cormorant Garamond', 'Playfair Display', serif;
  font-size: 1.1rem;
  font-weight: 700;
  margin-bottom: 9px;
  position: relative;
  z-index: 1;
}

.proc-card p {
  color: var(--fog);
  font-size: 13px;
  line-height: 1.7;
  position: relative;
  z-index: 1;
}

/* ─── WHY US ─── */
.why-layout {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 80px;
  align-items: center;
}

.why-left .sec-tag {
  justify-content: flex-start;
}

.why-left .sec-tag::before {
  display: none;
}

.why-left h2 {
  font-family: 'Cormorant Garamond', 'Playfair Display', serif;
  font-size: clamp(1.9rem, 3.2vw, 2.6rem);
  font-weight: 800;
  margin-bottom: 16px;
}

.why-body {
  color: var(--fog);
  font-size: 15px;
  line-height: 1.85;
  margin-bottom: 36px;
}

.why-feats {
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.wf {
  display: flex;
  gap: 16px;
  align-items: flex-start;
  border-radius: 14px;
  padding: 12px;
  transition: background .2s;
  cursor: none;
}

.wf:hover {
  background: rgba(232, 160, 32, .04);
}

.wf-icon {
  font-size: 22px;
  width: 46px;
  height: 46px;
  border-radius: 13px;
  background: rgba(232, 160, 32, .08);
  border: 1px solid rgba(232, 160, 32, .14);
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  transition: transform .3s;
  position: relative;
  z-index: 1;
}

.wf:hover .wf-icon {
  transform: scale(1.1) rotate(-4deg);
}

.wf h4 {
  font-weight: 600;
  font-size: 14.5px;
  margin-bottom: 4px;
}

.wf p {
  color: var(--fog);
  font-size: 13px;
  line-height: 1.6;
}

.why-right {
  position: relative;
  padding: 20px;
}

.why-card {
  background: var(--slate);
  border: 1px solid rgba(232, 160, 32, .18);
  border-radius: 22px;
  padding: 34px;
  position: relative;
  overflow: hidden;
  cursor: none;
}

.wc-shine {
  position: absolute;
  top: -60px;
  right: -60px;
  width: 180px;
  height: 180px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(232, 160, 32, .1), transparent 70%);
  pointer-events: none;
}

.wc-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 18px;
}

.wc-icon {
  font-size: 42px;
}

.wc-badge {
  background: linear-gradient(135deg, var(--gold), var(--gold-dim));
  color: #fff;
  font-size: 10.5px;
  font-weight: 700;
  padding: 5px 14px;
  border-radius: 50px;
  letter-spacing: .08em;
}

.why-card h3 {
  font-family: 'Cormorant Garamond', 'Playfair Display', serif;
  font-size: 1.35rem;
  font-weight: 700;
  margin-bottom: 11px;
  position: relative;
  z-index: 1;
}

.why-card p {
  color: var(--fog);
  font-size: 14px;
  line-height: 1.75;
  margin-bottom: 20px;
  position: relative;
  z-index: 1;
}

.wc-checks {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 8px;
  position: relative;
  z-index: 1;
}

.wc-checks span {
  font-size: 13px;
  color: var(--fog);
}

.fc-stat {
  position: absolute;
  background: var(--panel);
  border: 1px solid var(--rim);
  border-radius: 14px;
  padding: 14px 17px;
  text-align: center;
  box-shadow: 0 16px 38px rgba(0, 0, 0, .5);
  animation: fstat 5s ease-in-out infinite;
}

.fc-stat strong {
  display: block;
  font-family: 'Cormorant Garamond', 'Playfair Display', serif;
  font-size: 1.7rem;
  font-weight: 800;
  color: var(--gold);
}

.fc-stat span {
  font-size: 10.5px;
  color: var(--fog);
  text-transform: uppercase;
  letter-spacing: .1em;
}

.st1 {
  top: -14px;
  right: -14px;
  animation-delay: 0s;
}

.st2 {
  bottom: -14px;
  left: -18px;
  animation-delay: 1.6s;
}

.st3 {
  bottom: 56px;
  right: -18px;
  animation-delay: 3s;
}

.st-stars {
  color: var(--gold-lt);
  font-size: 12px;
  margin-bottom: 3px;
}

@keyframes fstat {

  0%,
  100% {
    transform: translateY(0)
  }

  50% {
    transform: translateY(-9px)
  }
}

/* ─── TESTIMONIALS ─── */
.testi-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 18px;
}

.testi-card {
  background: var(--slate);
  border: 1px solid var(--rim);
  border-radius: 20px;
  padding: 30px;
  position: relative;
  overflow: hidden;
  transition: border-color .3s, box-shadow .3s;
  cursor: none;
}

.testi-card:hover {
  border-color: var(--rim2);
  box-shadow: 0 18px 44px rgba(0, 0, 0, .4);
}

.tq {
  font-family: 'Cormorant Garamond', 'Playfair Display', serif;
  font-size: 4.5rem;
  line-height: .55;
  color: rgba(232, 160, 32, .1);
  font-weight: 900;
  margin-bottom: 12px;
}

.t-stars {
  color: var(--gold-lt);
  font-size: 12px;
  letter-spacing: 3px;
  margin-bottom: 13px;
}

.testi-card p {
  color: var(--fog);
  font-size: 13.5px;
  line-height: 1.8;
  margin-bottom: 20px;
  font-style: italic;
  position: relative;
  z-index: 1;
}

.t-author {
  display: flex;
  align-items: center;
  gap: 11px;
  position: relative;
  z-index: 1;
}

.t-av {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background: linear-gradient(135deg, var(--gold), var(--teal));
  display: flex;
  align-items: center;
  justify-content: center;
  font-family: 'Cormorant Garamond', serif;
  font-weight: 700;
  font-size: .95rem;
  color: #fff;
  flex-shrink: 0;
}

.t-author strong {
  display: block;
  font-size: 13.5px;
  font-weight: 600;
}

.t-author small {
  color: var(--fog);
  font-size: 12px;
}

.t-author>div {
  flex: 1;
}

.t-tag {
  font-size: 10.5px;
  font-weight: 700;
  color: var(--gold);
  background: var(--gold-glow);
  border: 1px solid rgba(232, 160, 32, .18);
  padding: 4px 10px;
  border-radius: 50px;
  white-space: nowrap;
}

/* ─── CTA ─── */
.cta-band {
  background: linear-gradient(135deg, #0e0b04 0%, #0a0e18 50%, #060811 100%);
  padding: 96px 0;
  position: relative;
  overflow: hidden;
}

.cta-light {
  position: absolute;
  top: -80px;
  left: 50%;
  transform: translateX(-50%);
  width: 600px;
  height: 350px;
  background: radial-gradient(ellipse, rgba(232, 160, 32, .12) 0%, transparent 70%);
  pointer-events: none;
}

.cta-mesh {
  position: absolute;
  inset: 0;
  background-image: linear-gradient(rgba(232, 160, 32, .03) 1px, transparent 1px), linear-gradient(90deg, rgba(232, 160, 32, .03) 1px, transparent 1px);
  background-size: 48px 48px;
}

.cta-row {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 40px;
  flex-wrap: wrap;
  position: relative;
  z-index: 1;
}

.cta-words h2 {
  font-family: 'Cormorant Garamond', 'Playfair Display', serif;
  font-size: clamp(1.8rem, 3.5vw, 2.8rem);
  font-weight: 800;
  margin-bottom: 11px;
}

.cta-words p {
  color: var(--fog);
  font-size: 15.5px;
}

.cta-btns {
  display: flex;
  gap: 13px;
  flex-wrap: wrap;
}

/* ─── RESPONSIVE ─── */
@media(max-width:1024px) {
  .svc-grid {
    grid-template-columns: repeat(2, 1fr);
  }

  .svc-card.large {
    grid-column: span 1;
  }

  .proc-grid {
    grid-template-columns: repeat(2, 1fr);
  }

  .why-layout {
    grid-template-columns: 1fr;
    gap: 56px;
  }

  .why-right {
    display: none;
  }

  .testi-grid {
    grid-template-columns: repeat(2, 1fr);
  }

  .cta-row {
    flex-direction: column;
    text-align: center;
  }

  .cta-btns {
    justify-content: center;
  }
}

@media(max-width:768px) {
  .section {
    padding: 72px 0;
  }

  .hero-body {
    padding: 72px 28px 56px;
  }

  .svc-grid,
  .proc-grid,
  .testi-grid {
    grid-template-columns: 1fr;
  }

  /* hide stickers on mobile */
  .sticker-field,
  .cursor-ring,
  .cursor-dot,
  .cursor-trail {
    display: none;
  }

  .home {
    cursor: auto;
  }
}

@media(max-width:480px) {

  .hero-cta,
  .cta-btns {
    flex-direction: column;
    align-items: center;
  }

  .hero-cta a,
  .cta-btns a {
    width: 100%;
    justify-content: center;
  }
}
</style>
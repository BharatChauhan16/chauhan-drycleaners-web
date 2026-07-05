<template>
  <div class="pg">

    <!-- HERO -->
    <div class="page-hero">
      <div class="ph-bg">
        <div class="ph-orb ph-orb1"></div>
        <div class="ph-orb ph-orb2"></div>
        <div class="ph-grid"></div>
        <div class="ph-noise"></div>
      </div>
      <div class="container ph-body">
        <div class="breadcrumb" v-obs>
          <router-link to="/">Home</router-link>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M9 18l6-6-6-6" />
          </svg>
          <span>Contact</span>
        </div>
        <div class="hero-tag" v-obs>Available 7 Days a Week</div>
        <h1 v-obs>We're Here to <em class="accent">Help You</em></h1>
        <p v-obs>Questions, orders, feedback — reach out and we'll respond within a few hours. Our team in Saharanpur is
          always ready to serve you.</p>
        <div class="hero-trust" v-obs>
          <div class="ht-item" v-for="t in trust" :key="t.label">
            <span class="ht-icon">{{ t.icon }}</span>
            <span>{{ t.label }}</span>
          </div>
        </div>
      </div>
      <div class="hero-img-wrap">
        <img src="https://images.unsplash.com/photo-1545173168-9f1947eebb7f?w=600&q=80&auto=format&fit=crop"
          alt="Professional dry cleaning service" class="hero-img" loading="eager" />
        <div class="hero-img-overlay"></div>
        <div class="hero-badge">
          <span class="hb-num">500+</span>
          <span class="hb-lbl">Happy Customers</span>
        </div>
      </div>
    </div>

    <!-- CONTACT CARDS -->
    <div class="cards-strip">
      <div class="container">
        <div class="contact-cards" v-obs>
          <a v-for="c in cards" :key="c.label" :href="c.href" class="cc">
            <div class="cc-ico">{{ c.icon }}</div>
            <div class="cc-body">
              <small>{{ c.label }}</small>
              <strong>{{ c.value }}</strong>
              <span>{{ c.action }}</span>
            </div>
            <svg class="cc-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M5 12h14M12 5l7 7-7 7" />
            </svg>
          </a>
        </div>
      </div>
    </div>

    <!-- MAIN SECTION -->
    <section class="section">
      <div class="container">
        <div class="contact-grid">

          <!-- FORM -->
          <div class="form-wrap" v-obs>
            <div class="form-header">
              <div class="fh-pill">Send a Message</div>
              <h2 class="form-title">Tell Us How We<br />Can Help</h2>
              <p class="form-sub">We respond to all messages within 24 hours.</p>
            </div>

            <div v-if="sent" class="success">
              <div class="suc-ring">
                <div class="suc-ico">✓</div>
              </div>
              <h3>Message Sent!</h3>
              <p>We'll get back to you within 24 hours. Meanwhile, feel free to call us.</p>
              <a href="tel:+918534837704" class="btn-outline">Call Now</a>
              <button class="btn-gold" @click="reset">Send Another</button>
            </div>

            <form v-else @submit.prevent="submit" novalidate>
              <div class="form-row">
                <div class="fg" :class="{ err: errors.name }">
                  <label>Full Name *</label>
                  <div class="inp-wrap">
                   
                    <input v-model="c.name" type="text" @blur="val('name')" />
                  </div>
                  <span class="em" v-if="errors.name">{{ errors.name }}</span>
                </div>
                <div class="fg" :class="{ err: errors.phone }">
                  <label>Phone Number *</label>
                  <div class="inp-wrap">
                    <input v-model="c.phone" type="tel" @blur="val('phone')" />
                  </div>
                  <span class="em" v-if="errors.phone">{{ errors.phone }}</span>
                </div>
              </div>

              <div class="fg">
                <label>Email Address <span class="opt">(optional)</span></label>
                <div class="inp-wrap">
                  <input v-model="c.email" type="email" />
                </div>
              </div>

              <div class="fg" :class="{ err: errors.subject }">
                <label>Subject *</label>
                <div class="inp-wrap select-wrap">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M4 6h16M4 12h16M4 18h10" />
                  </svg>
                  <select v-model="c.subject" @blur="val('subject')">
                    <option value="" disabled>Select a subject…</option>
                    <option v-for="s in subjects" :key="s" :value="s">{{ s }}</option>
                  </select>
                </div>
                <span class="em" v-if="errors.subject">{{ errors.subject }}</span>
              </div>

              <div class="fg" :class="{ err: errors.message }">
                <label>Your Message *</label>
                <textarea v-model="c.message" rows="5"
                  @blur="val('message')"></textarea>
                <span class="char-count">{{ c.message.length }}/500</span>
                <span class="em" v-if="errors.message">{{ errors.message }}</span>
              </div>

              <p v-if="submitErr" class="sub-err">⚠ {{ submitErr }}</p>

              <button type="submit" class="btn-gold" :disabled="loading">
                <span v-if="loading" class="ldots"><span></span><span></span><span></span></span>
                <template v-else>
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z" />
                  </svg>
                  <span>Send Message</span>
                </template>
              </button>
              <p class="form-note">🔒 Your information is never shared with third parties.</p>
            </form>
          </div>

          <!-- INFO COLUMN -->
          <div class="info-col">

            <!-- HOURS -->
            <div class="info-card" v-obs>
              <div class="ic-header">
                <div class="ic-icon">🕐</div>
                <div>
                  <h4>Business Hours</h4>
                  <p class="ic-sub">We're open most of the week</p>
                </div>
                <div class="open-now-badge" v-if="isOpenNow">
                  <span></span> Open Now
                </div>
              </div>
              <div class="hours">
                <div class="h-row" v-for="h in hours" :key="h.day" :class="{ today: h.today }">
                  <span class="h-day">{{ h.day }}</span>
                  <div class="h-right">
                    <span class="h-time">{{ h.time }}</span>
                    <span class="h-badge" v-if="h.today">Today</span>
                  </div>
                </div>
              </div>
            </div>

            <!-- PHOTO + MAP CARD -->
            <div class="info-card location-card" v-obs>
              <div class="loc-photo">
                <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=600&q=80&auto=format&fit=crop"
                  alt="Our dry cleaning shop" loading="lazy" />
                <div class="loc-photo-overlay">
                  <div class="lpo-tag">📍 Saharanpur, UP</div>
                </div>
              </div>
              <div class="ic-header" style="margin-bottom: 14px;">
                <div class="ic-icon">📍</div>
                <div>
                  <h4>Find Us</h4>
                  <p class="ic-sub">We'd love to see you in person</p>
                </div>
              </div>
              <div class="map-embed-wrap">
                <iframe
                  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3456.1503448841318!2d77.549493475388!3d29.975108974958538!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390eebc23fc72d85%3A0x265c10d31a584b72!2sChauhan%20Dry%20Cleaners!5e0!3m2!1sen!2sin!4v1775687465155!5m2!1sen!2sin"
                  width="100%" height="170" style="border:0; border-radius: 12px; display: block;" allowfullscreen=""
                  loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
              </div>
              <div class="map-addr">
                <strong>Chauhan Dry Cleaners</strong>
                <p>2, Khumran Pul Road, Nawabganj<br />Khaaran, Saharanpur, UP 247001</p>
                <a href="https://maps.app.goo.gl/3n8PKJzi1ZVLmwMb8" target="_blank" class="dir-link">
                  Get Directions
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6M15 3h6v6M10 14L21 3" />
                  </svg>
                </a>
              </div>
            </div>

            <!-- FAQ -->
            <div class="info-card" v-obs>
              <div class="ic-header" style="margin-bottom:16px;">
                <div class="ic-icon">💬</div>
                <div>
                  <h4>Quick FAQs</h4>
                  <p class="ic-sub">Answers to common questions</p>
                </div>
              </div>
              <div class="faqs">
                <div v-for="faq in faqs" :key="faq.q" class="faq" :class="{ open: faq.open }">
                  <button class="faq-q" @click="faq.open = !faq.open">
                    <span>{{ faq.q }}</span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                      :style="{ transform: faq.open ? 'rotate(180deg)' : '', transition: 'transform .25s' }">
                      <path d="M6 9l6 6 6-6" />
                    </svg>
                  </button>
                  <div class="faq-a-wrap" :style="{ maxHeight: faq.open ? '160px' : '0' }">
                    <p class="faq-a">{{ faq.a }}</p>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>

    <!-- BOTTOM STRIP — SOCIAL PROOF -->
    <div class="proof-strip">
      <div class="container">
        <div class="proof-grid" v-obs>
          <div class="proof-img-col">
            <img src="https://images.unsplash.com/photo-1517677208171-0bc6725a3e60?w=500&q=80&auto=format&fit=crop"
              alt="Quality garment care" loading="lazy" class="proof-img" />
            <img src="https://images.unsplash.com/photo-1626806819282-2c1dc01a5e0c?w=500&q=80&auto=format&fit=crop"
              alt="Expert pressing and finishing" loading="lazy" class="proof-img" />
          </div>
          <div class="proof-copy">
            <div class="fh-pill">Why Choose Us</div>
            <h2>Trusted by Families<br />Across Saharanpur</h2>
            <p>From everyday wear to bridal outfits, we treat every garment with the same expert care. Free pickup,
              premium
              results, and a satisfaction guarantee.</p>
            <div class="proof-stats">
              <div class="ps-item" v-for="s in stats" :key="s.label">
                <strong>{{ s.num }}</strong>
                <span>{{ s.label }}</span>
              </div>
            </div>
            <a href="tel:+918534837704" class="btn-gold" style="width: auto; padding: 14px 32px;">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <path
                  d="M22 16.92v3a2 2 0 01-2.18 2 19.8 19.8 0 01-8.63-3.07A19.5 19.5 0 013.07 9.77 19.8 19.8 0 01.07 1.18 2 2 0 012 0h3a2 2 0 012 1.72c.13.96.36 1.9.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.9.34 1.85.57 2.81.7A2 2 0 0122 14.92z" />
              </svg>
              Call +91 85348 37704
            </a>
          </div>
        </div>
      </div>
    </div>

  </div>
</template>

<script setup>
import { ref, reactive, computed } from 'vue'
import axios from 'axios'

const vObs = {
  mounted(el) {
    el.style.cssText += `opacity:0;transform:translateY(28px);transition:opacity .7s cubic-bezier(.16,1,.3,1),transform .7s cubic-bezier(.16,1,.3,1);`
    const io = new IntersectionObserver(([e]) => {
      if (e.isIntersecting) { el.style.opacity = '1'; el.style.transform = 'translateY(0)'; io.disconnect() }
    }, { threshold: 0.05 })
    io.observe(el)
  }
}

const sent = ref(false)
const loading = ref(false)
const submitErr = ref('')
const errors = ref({})
const c = ref({ name: '', phone: '', email: '', subject: '', message: '' })

const trust = [
  { icon: '✅', label: 'Free Pickup & Delivery' },
  { icon: '⭐', label: '100% Satisfaction Guarantee' },
  { icon: '🧵', label: 'Expert Garment Care' },
]

const stats = [
  { num: '500+', label: 'Happy Customers' },
  { num: '10+', label: 'Years Experience' },
  { num: '24h', label: 'Express Service' },
  { num: '100%', label: 'Satisfaction' },
]

const cards = [
  { icon: '📞', label: 'Call Us', value: '+91 85348 37704', action: 'Tap to call', href: 'tel:+918534837704' },
  { icon: '✉️', label: 'Email Us', value: 'chauhandrycleaners05@gmail.com', action: 'Tap to email', href: 'mailto:chauhandrycleaners05@gmail.com' },
  { icon: '💬', label: 'WhatsApp', value: '+91 85348 37704', action: 'Chat instantly', href: 'https://wa.me/918534837704' },
  { icon: '📍', label: 'Visit Us', value: 'Nawabganj, Saharanpur', action: 'Get directions', href: 'https://maps.app.goo.gl/3n8PKJzi1ZVLmwMb8' },
]

const subjects = [
  'General Inquiry', 'Pricing & Services', 'Track My Order',
  'Complaint / Feedback', 'Corporate / Bulk Orders', 'Partnership',
]

const day = new Date().getDay()
const hours = [
  { day: 'Monday – Friday', time: '8:00 AM – 8:00 PM', today: day >= 1 && day <= 5 },
  { day: 'Saturday', time: '9:00 AM – 7:00 PM', today: day === 6 },
  { day: 'Sunday', time: '10:00 AM – 4:00 PM', today: day === 0 },
]

const isOpenNow = computed(() => {
  const now = new Date()
  const h = now.getHours()
  if (day >= 1 && day <= 5) return h >= 8 && h < 20
  if (day === 6) return h >= 9 && h < 19
  if (day === 0) return h >= 10 && h < 16
  return false
})

const faqs = reactive([
  { q: 'How long does dry cleaning take?', a: 'Standard service takes 2–3 business days. Express 24-hour service is available at a 50% surcharge.', open: false },
  { q: 'Do you offer home pickup & delivery?', a: 'Yes! We offer free home pickup and delivery across Saharanpur. Just book online, WhatsApp, or call us.', open: false },
  { q: 'How do you handle bridal outfits?', a: 'Bridal garments are handled by our senior technicians with specialised care protocols and a free pre-clean inspection.', open: false },
  { q: "What if I'm not satisfied?", a: "We offer a 100% satisfaction guarantee. If you're not happy, we'll re-clean your garments at no extra charge.", open: false },
  { q: 'Do you clean leather and suede?', a: 'Yes — leather, suede, and specialty fabrics are handled with dedicated processes by trained technicians.', open: false },
])

function val(field) {
  errors.value[field] = ''
  if (field === 'name' && !c.value.name.trim()) errors.value.name = 'Name is required.'
  if (field === 'phone' && !c.value.phone.trim()) errors.value.phone = 'Phone number is required.'
  if (field === 'subject' && !c.value.subject) errors.value.subject = 'Please select a subject.'
  if (field === 'message' && !c.value.message.trim()) errors.value.message = 'Message is required.'
}

function valAll() {
  ;['name', 'phone', 'subject', 'message'].forEach(val)
  return Object.values(errors.value).every(e => !e)
}

async function submit() {
  if (!valAll()) return
  loading.value = true; submitErr.value = ''
  try {
    await axios.post('/api/v1/contact', c.value)
    sent.value = true
  } catch {
    submitErr.value = 'Something went wrong. Please try again or call us directly.'
  } finally { loading.value = false }
}

function reset() {
  c.value = { name: '', phone: '', email: '', subject: '', message: '' }
  errors.value = {}; sent.value = false
}
</script>

<style scoped>
:root {
  --void: #060911;
  --abyss: #0B1018;
  --slate: #111827;
  --panel: #1A2333;
  --rim: rgba(255, 255, 255, 0.07);
  --rim2: rgba(232, 160, 32, 0.22);
  --gold: #E8A020;
  --gold-lt: #F5C842;
  --gold-dim: #7A4A00;
  --gold-glow: rgba(232, 160, 32, 0.15);
  --teal: #0EA5A0;
  --cream: #F2EDE4;
  --fog: rgba(242, 237, 228, 0.52);
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
  max-width: 1240px;
  margin: 0 auto;
  padding: 0 28px;
}

/* ── HERO ── */
.page-hero {
  position: relative;
  overflow: hidden;
  padding: 90px 0 72px;
  display: grid;
  grid-template-columns: 1fr 420px;
  align-items: center;
  gap: 0;
  max-width: 1240px;
  margin: 0 auto;
}

.ph-bg {
  position: fixed;
  inset: 0;
  pointer-events: none;
  z-index: 0;
}

.ph-orb {
  position: absolute;
  border-radius: 50%;
}

.ph-orb1 {
  width: 500px;
  height: 500px;
  background: radial-gradient(circle, rgba(232, 160, 32, .12) 0%, transparent 65%);
  top: -150px;
  right: -100px;
}

.ph-orb2 {
  width: 280px;
  height: 280px;
  background: radial-gradient(circle, rgba(14, 165, 160, .08) 0%, transparent 65%);
  bottom: -60px;
  left: 200px;
}

.ph-grid {
  position: absolute;
  inset: 0;
  background-image: linear-gradient(rgba(255, 255, 255, .015) 1px, transparent 1px), linear-gradient(90deg, rgba(255, 255, 255, .015) 1px, transparent 1px);
  background-size: 64px 64px;
}

.ph-noise {
  position: absolute;
  inset: 0;
  opacity: .025;
  background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.9' numOctaves='4'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
}

.ph-body {
  position: relative;
  z-index: 1;
  padding: 0 28px;
}

.breadcrumb {
  display: flex;
  align-items: center;
  gap: 6px;
  font-size: 12.5px;
  color: var(--fog);
  margin-bottom: 18px;
}

.breadcrumb a {
  color: var(--gold);
  text-decoration: none;
}

.breadcrumb svg {
  width: 13px;
  height: 13px;
}

.hero-tag {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  background: rgba(232, 160, 32, .1);
  border: 1px solid rgba(232, 160, 32, .25);
  color: var(--gold-lt);
  font-size: 11.5px;
  font-weight: 600;
  letter-spacing: .08em;
  text-transform: uppercase;
  padding: 5px 14px;
  border-radius: 50px;
  margin-bottom: 18px;
}

.hero-tag::before {
  content: '';
  width: 6px;
  height: 6px;
  border-radius: 50%;
  background: var(--gold-lt);
  animation: pulse 2s ease infinite;
}

@keyframes pulse {

  0%,
  100% {
    opacity: 1;
    transform: scale(1)
  }

  50% {
    opacity: .5;
    transform: scale(.75)
  }
}

.ph-body h1 {
  font-family: 'Cormorant Garamond', 'Playfair Display', serif;
  font-size: clamp(2.6rem, 4.5vw, 4rem);
  font-weight: 900;
  line-height: 1.1;
  margin-bottom: 16px;
}

.accent {
  color: var(--gold);
  font-style: normal;
}

.ph-body p {
  color: var(--fog);
  font-size: 16px;
  line-height: 1.75;
  max-width: 500px;
  margin-bottom: 26px;
}

.hero-trust {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
}

.ht-item {
  display: flex;
  align-items: center;
  gap: 7px;
  background: rgba(255, 255, 255, .04);
  border: 1px solid var(--rim);
  border-radius: 50px;
  padding: 7px 14px;
  font-size: 12px;
  color: var(--fog);
}

.ht-icon {
  font-size: 14px;
}

/* hero image */
.hero-img-wrap {
  position: relative;
  z-index: 1;
  padding-right: 28px;
}

.hero-img {
  width: 100%;
  height: 340px;
  object-fit: cover;
  border-radius: 22px;
  display: block;
  border: 1px solid var(--rim);
}

.hero-img-overlay {
  position: absolute;
  inset: 0;
  right: 28px;
  border-radius: 22px;
  background: linear-gradient(to right, rgba(6, 9, 17, .6) 0%, transparent 50%);
}

.hero-badge {
  position: absolute;
  bottom: 22px;
  left: 22px;
  background: rgba(11, 16, 24, .9);
  backdrop-filter: blur(12px);
  border: 1px solid rgba(232, 160, 32, .3);
  border-radius: 14px;
  padding: 12px 18px;
  text-align: center;
}

.hb-num {
  display: block;
  font-family: 'Cormorant Garamond', serif;
  font-size: 1.6rem;
  font-weight: 800;
  color: var(--gold-lt);
  line-height: 1;
}

.hb-lbl {
  display: block;
  font-size: 10.5px;
  color: var(--fog);
  letter-spacing: .07em;
  margin-top: 3px;
}

/* ── CARDS STRIP ── */
.cards-strip {
  background: var(--abyss);
  border-top: 1px solid var(--rim);
  border-bottom: 1px solid var(--rim);
  padding: 24px 0;
}

.contact-cards {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 12px;
}

.cc {
  display: flex;
  align-items: center;
  gap: 13px;
  background: var(--slate);
  border: 1px solid var(--rim);
  border-radius: 16px;
  padding: 17px;
  text-decoration: none;
  transition: all .22s;
  position: relative;
  overflow: hidden;
}

.cc::before {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(135deg, var(--gold-glow), transparent);
  opacity: 0;
  transition: opacity .22s;
}

.cc:hover {
  border-color: var(--rim2);
  transform: translateY(-3px);
  box-shadow: 0 14px 36px rgba(0, 0, 0, .45);
}

.cc:hover::before {
  opacity: 1;
}

.cc-ico {
  font-size: 22px;
  flex-shrink: 0;
  width: 46px;
  height: 46px;
  background: rgba(232, 160, 32, .09);
  border: 1px solid rgba(232, 160, 32, .18);
  border-radius: 13px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.cc-body {
  flex: 1;
  min-width: 0;
}

.cc-body small {
  display: block;
  font-size: 10px;
  color: var(--fog);
  letter-spacing: .1em;
  text-transform: uppercase;
  margin-bottom: 2px;
}

.cc-body strong {
  display: block;
  font-size: 12px;
  font-weight: 600;
  color: var(--cream);
  margin-bottom: 2px;
  word-break: break-all;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.cc-body span {
  font-size: 11px;
  color: var(--gold);
}

.cc-arrow {
  width: 16px;
  height: 16px;
  flex-shrink: 0;
  color: var(--fog);
  transition: transform .2s, color .2s;
}

.cc:hover .cc-arrow {
  transform: translateX(3px);
  color: var(--gold);
}

/* ── SECTION ── */
.section {
  padding: 72px 0 88px;
}

.contact-grid {
  display: grid;
  grid-template-columns: 1.15fr 1fr;
  gap: 28px;
  align-items: start;
}

/* ── FORM ── */
.form-wrap {
  background: var(--slate);
  border: 1px solid var(--rim);
  border-radius: 24px;
  padding: 40px;
  position: relative;
  overflow: hidden;
}

.form-wrap::before {
  content: '';
  position: absolute;
  top: -60px;
  right: -60px;
  width: 200px;
  height: 200px;
  border-radius: 50%;
  background: radial-gradient(circle, var(--gold-glow), transparent 70%);
  pointer-events: none;
}

.form-header {
  margin-bottom: 30px;
}

.fh-pill {
  display: inline-block;
  background: rgba(232, 160, 32, .1);
  border: 1px solid rgba(232, 160, 32, .22);
  color: var(--gold);
  font-size: 11px;
  font-weight: 700;
  letter-spacing: .09em;
  text-transform: uppercase;
  padding: 4px 12px;
  border-radius: 50px;
  margin-bottom: 12px;
}

.form-title {
  font-family: 'Cormorant Garamond', 'Playfair Display', serif;
  font-size: 1.8rem;
  font-weight: 900;
  line-height: 1.2;
  margin-bottom: 7px;
}

.form-sub {
  font-size: 13px;
  color: var(--fog);
}

.opt {
  font-weight: 400;
  color: var(--mist);
}

form {
  display: flex;
  flex-direction: column;
  gap: 15px;
}

.form-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 13px;
}

.fg {
  display: flex;
  flex-direction: column;
  gap: 6px;
  position: relative;
}

.fg label {
  font-size: 12px;
  font-weight: 600;
  color: var(--fog);
  letter-spacing: .03em;
}

.inp-wrap {
  position: relative;
}

.inp-wrap svg {
  position: absolute;
  left: 13px;
  top: 50%;
  transform: translateY(-50%);
  width: 15px;
  height: 15px;
  color: var(--mist);
  pointer-events: none;
  transition: color .2s;
}

.inp-wrap input,
.inp-wrap.select-wrap select {
  padding-left: 38px;
}

.fg input,
.fg select,
.fg textarea {
  width: 100%;
  background: var(--panel);
  border: 1.5px solid rgba(255, 255, 255, .1);
  color: var(--cream);
  font-family: 'DM Sans', system-ui, sans-serif;
  font-size: 13.5px;
  padding: 12px 14px;
  border-radius: 12px;
  outline: none;
  transition: border-color .2s, box-shadow .2s, background .2s;
  -webkit-appearance: none;
  appearance: none;
}

.fg input:focus,
.fg select:focus,
.fg textarea:focus {
  border-color: var(--gold);
  box-shadow: 0 0 0 3px rgba(232, 160, 32, .15);
  background: #1f2d42;
}

.fg input:focus~svg,
.fg select:focus~svg {
  color: var(--gold);
}

.inp-wrap:focus-within svg {
  color: var(--gold);
}

.fg input:hover:not(:focus),
.fg select:hover:not(:focus),
.fg textarea:hover:not(:focus) {
  border-color: rgba(255, 255, 255, .2);
}

.fg input::placeholder,
.fg textarea::placeholder {
  color: var(--mist);
}

.fg select {
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23E8A020' stroke-width='2'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
  background-repeat: no-repeat;
  background-position: right 13px center;
  background-size: 15px;
  padding-right: 38px;
  cursor: pointer;
}

.fg select option {
  background-color: #1A2333;
  color: #F2EDE4;
  font-size: 13.5px;
}

.fg select option:disabled {
  color: rgba(242, 237, 228, .35);
}

.fg textarea {
  resize: vertical;
  min-height: 96px;
}

.char-count {
  align-self: flex-end;
  font-size: 10.5px;
  color: var(--mist);
  margin-top: -2px;
}

.fg.err input,
.fg.err select,
.fg.err textarea {
  border-color: #F87171;
  box-shadow: 0 0 0 3px rgba(248, 113, 113, .1);
}

.em {
  font-size: 11.5px;
  color: #F87171;
}

.sub-err {
  color: #F87171;
  font-size: 12.5px;
  padding: 8px 12px;
  background: rgba(248, 113, 113, .08);
  border-radius: 8px;
  border: 1px solid rgba(248, 113, 113, .2);
}

.form-note {
  font-size: 11px;
  color: var(--mist);
  text-align: center;
  margin-top: -4px;
}

.btn-gold {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 9px;
  background: linear-gradient(135deg, var(--gold) 0%, #c47a10 100%);
  color: #fff;
  font-weight: 700;
  font-size: 14px;
  padding: 14px 26px;
  border-radius: 50px;
  border: none;
  cursor: pointer;
  text-decoration: none;
  box-shadow: 0 6px 24px rgba(232, 160, 32, .35);
  transition: all .22s;
  width: 100%;
}

.btn-gold:hover:not(:disabled) {
  transform: translateY(-2px);
  box-shadow: 0 12px 32px rgba(232, 160, 32, .5);
}

.btn-gold:disabled {
  opacity: .42;
  cursor: not-allowed;
}

.btn-gold svg {
  width: 16px;
  height: 16px;
  flex-shrink: 0;
}

.btn-outline {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  background: transparent;
  color: var(--gold);
  font-weight: 600;
  font-size: 14px;
  padding: 12px 24px;
  border-radius: 50px;
  border: 1.5px solid var(--gold);
  text-decoration: none;
  transition: all .2s;
}

.btn-outline:hover {
  background: var(--gold-glow);
}

/* success */
.success {
  text-align: center;
  padding: 48px 0;
}

.suc-ring {
  width: 72px;
  height: 72px;
  border-radius: 50%;
  border: 2px solid rgba(232, 160, 32, .3);
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 20px;
  animation: ring-pop .5s cubic-bezier(.16, 1, .3, 1);
}

@keyframes ring-pop {
  from {
    transform: scale(.5);
    opacity: 0
  }

  to {
    transform: scale(1);
    opacity: 1
  }
}

.suc-ico {
  font-size: 26px;
  color: var(--gold-lt);
  font-weight: 700;
}

.success h3 {
  font-family: 'Cormorant Garamond', serif;
  font-size: 1.7rem;
  margin-bottom: 8px;
}

.success p {
  color: var(--fog);
  font-size: 14px;
  margin-bottom: 22px;
  line-height: 1.6;
}

.success .btn-outline {
  margin-bottom: 12px;
  width: 100%;
}

.success .btn-gold {
  margin-top: 0;
}

.ldots {
  display: flex;
  gap: 5px;
  align-items: center;
}

.ldots span {
  width: 5.5px;
  height: 5.5px;
  border-radius: 50%;
  background: #fff;
  animation: ld 1.2s ease infinite;
}

.ldots span:nth-child(2) {
  animation-delay: .2s;
}

.ldots span:nth-child(3) {
  animation-delay: .4s;
}

@keyframes ld {

  0%,
  100% {
    opacity: .25;
    transform: scale(.8)
  }

  50% {
    opacity: 1;
    transform: scale(1)
  }
}

/* ── INFO COL ── */
.info-col {
  display: flex;
  flex-direction: column;
  gap: 18px;
}

.info-card {
  background: var(--slate);
  border: 1px solid var(--rim);
  border-radius: 20px;
  padding: 24px;
  overflow: hidden;
}

.ic-header {
  display: flex;
  align-items: flex-start;
  gap: 12px;
  margin-bottom: 18px;
}

.ic-icon {
  font-size: 20px;
  width: 42px;
  height: 42px;
  background: rgba(232, 160, 32, .09);
  border: 1px solid rgba(232, 160, 32, .18);
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}

.ic-header h4 {
  font-family: 'Cormorant Garamond', serif;
  font-size: 1.1rem;
  font-weight: 700;
  margin-bottom: 3px;
}

.ic-sub {
  font-size: 11.5px;
  color: var(--fog);
}

.open-now-badge {
  margin-left: auto;
  display: flex;
  align-items: center;
  gap: 5px;
  background: rgba(34, 197, 94, .12);
  border: 1px solid rgba(34, 197, 94, .25);
  color: #4ade80;
  font-size: 11px;
  font-weight: 600;
  padding: 4px 10px;
  border-radius: 50px;
  white-space: nowrap;
  flex-shrink: 0;
}

.open-now-badge span {
  width: 6px;
  height: 6px;
  border-radius: 50%;
  background: #4ade80;
  animation: pulse 1.8s ease infinite;
}

/* hours */
.hours {
  display: flex;
  flex-direction: column;
}

.h-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 9px 0;
  border-bottom: 1px solid var(--rim);
  font-size: 12.5px;
}

.h-row:last-child {
  border-bottom: none;
}

.h-day {
  color: var(--fog);
}

.h-row.today .h-day {
  color: var(--gold-lt);
  font-weight: 600;
}

.h-right {
  display: flex;
  align-items: center;
  gap: 7px;
}

.h-time {
  font-weight: 500;
}

.h-badge {
  background: rgba(232, 160, 32, .14);
  color: var(--gold);
  font-size: 9.5px;
  font-weight: 700;
  padding: 2px 8px;
  border-radius: 50px;
  letter-spacing: .05em;
}

/* location card */
.location-card {
  padding: 0;
  overflow: hidden;
}

.loc-photo {
  position: relative;
  height: 160px;
}

.loc-photo img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}

.loc-photo-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(to bottom, transparent 30%, rgba(17, 24, 39, .85));
}

.lpo-tag {
  position: absolute;
  bottom: 12px;
  left: 14px;
  background: rgba(11, 16, 24, .8);
  backdrop-filter: blur(8px);
  border: 1px solid var(--rim2);
  border-radius: 8px;
  padding: 4px 11px;
  font-size: 11.5px;
  font-weight: 600;
  color: var(--gold-lt);
}

.map-embed-wrap {
  border-radius: 12px;
  overflow: hidden;
  border: 1px solid var(--rim);
  margin-bottom: 14px;
}

.location-card .ic-header,
.location-card .map-embed-wrap,
.location-card .map-addr {
  padding: 0 24px;
}

.location-card .ic-header {
  padding-top: 18px;
}

.location-card .map-addr {
  padding-bottom: 22px;
}

.map-addr strong {
  display: block;
  font-size: 13.5px;
  font-weight: 600;
  margin-bottom: 4px;
}

.map-addr p {
  font-size: 12.5px;
  color: var(--fog);
  line-height: 1.6;
  margin-bottom: 11px;
}

.dir-link {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  font-size: 12.5px;
  font-weight: 600;
  color: var(--gold);
  text-decoration: none;
  transition: gap .2s;
}

.dir-link:hover {
  gap: 9px;
}

.dir-link svg {
  width: 12px;
  height: 12px;
}

/* faq */
.faqs {
  display: flex;
  flex-direction: column;
}

.faq {
  border-bottom: 1px solid var(--rim);
}

.faq:last-child {
  border-bottom: none;
}

.faq-q {
  width: 100%;
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 11px;
  background: none;
  border: none;
  color: var(--cream);
  font-family: 'DM Sans', system-ui, sans-serif;
  font-size: 12.5px;
  font-weight: 500;
  padding: 13px 0;
  cursor: pointer;
  text-align: left;
}

.faq-q svg {
  width: 15px;
  height: 15px;
  flex-shrink: 0;
  color: var(--fog);
}

.faq.open .faq-q {
  color: var(--gold-lt);
}

.faq-a-wrap {
  overflow: hidden;
  transition: max-height .3s cubic-bezier(.16, 1, .3, 1);
}

.faq-a {
  font-size: 12.5px;
  color: var(--fog);
  line-height: 1.65;
  padding-bottom: 12px;
}

/* ── PROOF STRIP ── */
.proof-strip {
  background: var(--abyss);
  border-top: 1px solid var(--rim);
  padding: 80px 0;
}

.proof-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 56px;
  align-items: center;
}

.proof-img-col {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 14px;
}

.proof-img {
  width: 100%;
  height: 220px;
  object-fit: cover;
  border-radius: 18px;
  border: 1px solid var(--rim);
  display: block;
}

.proof-img:first-child {
  margin-top: 28px;
}

.proof-copy .fh-pill {
  margin-bottom: 14px;
}

.proof-copy h2 {
  font-family: 'Cormorant Garamond', serif;
  font-size: clamp(1.8rem, 3vw, 2.8rem);
  font-weight: 900;
  line-height: 1.15;
  margin-bottom: 14px;
}

.proof-copy p {
  color: var(--fog);
  font-size: 14.5px;
  line-height: 1.75;
  margin-bottom: 26px;
  max-width: 420px;
}

.proof-stats {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 14px;
  margin-bottom: 30px;
}

.ps-item {
  text-align: center;
  background: var(--slate);
  border: 1px solid var(--rim);
  border-radius: 14px;
  padding: 14px 8px;
}

.ps-item strong {
  display: block;
  font-family: 'Cormorant Garamond', serif;
  font-size: 1.5rem;
  font-weight: 800;
  color: var(--gold-lt);
  line-height: 1;
}

.ps-item span {
  display: block;
  font-size: 10.5px;
  color: var(--fog);
  margin-top: 4px;
}

.proof-copy .btn-gold {
  width: auto;
}

/* ── RESPONSIVE ── */
@media(max-width:1080px) {
  .page-hero {
    grid-template-columns: 1fr;
    padding: 70px 0 50px;
  }

  .hero-img-wrap {
    display: none;
  }

  .contact-grid {
    grid-template-columns: 1fr;
  }

  .proof-grid {
    grid-template-columns: 1fr;
    gap: 36px;
  }

  .proof-img-col {
    order: 2;
  }

  .proof-copy {
    order: 1;
  }
}

@media(max-width:768px) {
  .contact-cards {
    grid-template-columns: 1fr 1fr;
  }

  .form-wrap {
    padding: 26px 20px;
  }

  .form-row {
    grid-template-columns: 1fr;
  }

  .proof-stats {
    grid-template-columns: repeat(2, 1fr);
  }

  .proof-img:first-child {
    margin-top: 0;
  }
}

@media(max-width:480px) {
  .contact-cards {
    grid-template-columns: 1fr;
  }

  .proof-img-col {
    grid-template-columns: 1fr;
  }

  .proof-img {
    height: 180px;
  }
}
</style>
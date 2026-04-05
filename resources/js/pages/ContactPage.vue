<template>
  <div class="pg">

    <div class="page-hero">
      <div class="ph-bg">
        <div class="ph-orb"></div>
        <div class="ph-grid"></div>
      </div>
      <div class="container ph-body">
        <div class="breadcrumb" v-obs>
          <router-link to="/">Home</router-link>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M9 18l6-6-6-6" />
          </svg>
          <span>Contact</span>
        </div>
        <h1 v-obs>Get In <em class="accent">Touch</em></h1>
        <p v-obs>We'd love to hear from you. Reach out with questions, feedback, or to schedule a pickup.</p>
      </div>
    </div>

    <section class="section">
      <div class="container">

        <!-- CONTACT CARDS -->
        <div class="contact-cards" v-obs>
          <a v-for="c in cards" :key="c.label" :href="c.href" class="cc">
            <div class="cc-ico">{{ c.icon }}</div>
            <div class="cc-body">
              <small>{{ c.label }}</small>
              <strong>{{ c.value }}</strong>
              <span>{{ c.action }}</span>
            </div>
          </a>
        </div>

        <!-- FORM + INFO -->
        <div class="contact-grid">

          <!-- FORM -->
          <div class="form-wrap" v-obs>
            <div v-if="sent" class="success">
              <div class="suc-ico">🎉</div>
              <h3>Message Sent!</h3>
              <p>We'll get back to you within 24 hours.</p>
              <button class="btn-gold" @click="reset">Send Another</button>
            </div>
            <form v-else @submit.prevent="submit" novalidate>
              <h3 class="form-title">Send Us a Message</h3>
              <div class="form-row">
                <div class="fg" :class="{ err: errors.name }">
                  <label>Name *</label>
                  <input v-model="c.name" type="text" placeholder="Your name" @blur="val('name')" />
                  <span class="em" v-if="errors.name">{{ errors.name }}</span>
                </div>
                <div class="fg" :class="{ err: errors.phone }">
                  <label>Phone *</label>
                  <input v-model="c.phone" type="tel" placeholder="+91 XXXXX XXXXX" @blur="val('phone')" />
                  <span class="em" v-if="errors.phone">{{ errors.phone }}</span>
                </div>
              </div>
              <div class="fg">
                <label>Email</label>
                <input v-model="c.email" type="email" placeholder="your@email.com" />
              </div>
              <div class="fg" :class="{ err: errors.subject }">
                <label>Subject *</label>
                <select v-model="c.subject" @blur="val('subject')">
                  <option value="" disabled>Select a subject</option>
                  <option v-for="s in subjects" :key="s" :value="s">{{ s }}</option>
                </select>
                <span class="em" v-if="errors.subject">{{ errors.subject }}</span>
              </div>
              <div class="fg" :class="{ err: errors.message }">
                <label>Message *</label>
                <textarea v-model="c.message" rows="5" placeholder="Tell us how we can help you..."
                  @blur="val('message')"></textarea>
                <span class="em" v-if="errors.message">{{ errors.message }}</span>
              </div>
              <p v-if="submitErr" class="sub-err">{{ submitErr }}</p>
              <button type="submit" class="btn-gold" :disabled="loading">
                <span v-if="loading" class="ldots"><span></span><span></span><span></span></span>
                <template v-else>
                  <span>Send Message</span>
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z" />
                  </svg>
                </template>
              </button>
            </form>
          </div>

          <!-- INFO COLUMN -->
          <div class="info-col" v-obs>

            <!-- HOURS -->
            <div class="info-card">
              <h4><span>🕐</span> Business Hours</h4>
              <div class="hours">
                <div class="h-row" v-for="h in hours" :key="h.day" :class="{ today: h.today }">
                  <span>{{ h.day }}</span>
                  <div>
                    <span class="h-time">{{ h.time }}</span>
                    <span class="h-badge" v-if="h.today">Today</span>
                  </div>
                </div>
              </div>
            </div>

            <!-- MAP -->
            <div class="info-card map-card">
              <h4><span>📍</span> Find Us</h4>
              <div class="map-box">
                <div class="map-pin">📍</div>
                <div class="map-ripple"></div>
              </div>
              <div class="map-addr">
                <strong>Chauhan DryCleaners</strong>
                <p>123 Main Street, Civil Lines<br />Ludhiana, Punjab 141001</p>
                <a href="https://maps.google.com" target="_blank" class="dir-link">
                  Get Directions
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6M15 3h6v6M10 14L21 3" />
                  </svg>
                </a>
              </div>
            </div>

            <!-- FAQ -->
            <div class="info-card">
              <h4><span>💬</span> Quick FAQs</h4>
              <div class="faqs">
                <div v-for="faq in faqs" :key="faq.q" class="faq">
                  <button class="faq-q" @click="faq.open = !faq.open">
                    <span>{{ faq.q }}</span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                      :style="{ transform: faq.open ? 'rotate(180deg)' : '', transition: 'transform .2s' }">
                      <path d="M6 9l6 6 6-6" />
                    </svg>
                  </button>
                  <p v-show="faq.open" class="faq-a">{{ faq.a }}</p>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref, reactive } from 'vue'
import axios from 'axios'

const vObs = {
  mounted(el) {
    el.style.cssText += `opacity:0;transform:translateY(26px);transition:opacity .65s ease,transform .65s ease;`
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

const cards = [
  { icon: '📞', label: 'Call Us', value: '+91 85348 37704', action: 'Tap to call', href: 'tel:+918534837704' },
  { icon: '✉️', label: 'Email Us', value: 'info@chauhandrycleaners.com', action: 'Tap to email', href: 'mailto:info@chauhandrycleaners.com' },
  { icon: '💬', label: 'WhatsApp', value: '+91 85348 37704', action: 'Chat with us', href: 'https://wa.me/918534837704' },
  { icon: '📍', label: 'Visit Us', value: 'Civil Lines, Ludhiana', action: 'Get directions', href: 'https://maps.google.com' },
]

const subjects = [
  'General Inquiry', 'Pricing & Services', 'Track My Order',
  'Complaint / Feedback', 'Corporate / Bulk Orders', 'Partnership',
]

const hours = [
  { day: 'Monday – Friday', time: '8:00 AM – 8:00 PM', today: new Date().getDay() >= 1 && new Date().getDay() <= 5 },
  { day: 'Saturday', time: '9:00 AM – 7:00 PM', today: new Date().getDay() === 6 },
  { day: 'Sunday', time: '10:00 AM – 4:00 PM', today: new Date().getDay() === 0 },
]

const faqs = reactive([
  { q: 'How long does dry cleaning take?', a: 'Standard service takes 2-3 business days. Express 24-hour service is available at a 50% surcharge.', open: false },
  { q: 'Do you offer home pickup?', a: 'Yes! We offer free home pickup and delivery anywhere in Ludhiana. Just book online or call us.', open: false },
  { q: 'How do you handle bridal outfits?', a: 'Bridal garments are handled by our senior technicians with specialized care protocols. Free inspection before cleaning.', open: false },
  { q: "What if I'm not satisfied?", a: "We offer a 100% satisfaction guarantee. If you're not happy, we'll re-clean your garments at no extra charge.", open: false },
])

function val(field) {
  errors.value[field] = ''
  if (field === 'name' && !c.value.name.trim()) errors.value.name = 'Name is required.'
  if (field === 'phone' && !c.value.phone.trim()) errors.value.phone = 'Phone is required.'
  if (field === 'subject' && !c.value.subject) errors.value.subject = 'Please select a subject.'
  if (field === 'message' && !c.value.message.trim()) errors.value.message = 'Message is required.'
}

function valAll() {
  ['name', 'phone', 'subject', 'message'].forEach(val)
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

.pg {
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
  padding: 80px 0;
}

.accent {
  color: var(--gold);
  font-style: normal;
}

.page-hero {
  background: var(--abyss);
  position: relative;
  overflow: hidden;
  padding: 80px 0 56px;
  border-bottom: 1px solid var(--rim);
}

.ph-bg {
  position: absolute;
  inset: 0;
}

.ph-orb {
  position: absolute;
  width: 360px;
  height: 360px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(232, 160, 32, .1) 0%, transparent 65%);
  top: -90px;
  right: -90px;
}

.ph-grid {
  position: absolute;
  inset: 0;
  background-image: linear-gradient(rgba(255, 255, 255, .016) 1px, transparent 1px), linear-gradient(90deg, rgba(255, 255, 255, .016) 1px, transparent 1px);
  background-size: 60px 60px;
}

.ph-body {
  position: relative;
  z-index: 1;
  max-width: 640px;
}

.breadcrumb {
  display: flex;
  align-items: center;
  gap: 6px;
  font-size: 12.5px;
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
  font-size: clamp(2.4rem, 5vw, 3.8rem);
  font-weight: 900;
  margin-bottom: 13px;
}

.ph-body p {
  color: var(--fog);
  font-size: 16px;
  line-height: 1.7;
}

/* CONTACT CARDS */
.contact-cards {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 14px;
  margin-bottom: 44px;
}

.cc {
  display: flex;
  align-items: center;
  gap: 13px;
  background: var(--slate);
  border: 1px solid var(--rim);
  border-radius: 15px;
  padding: 18px;
  text-decoration: none;
  transition: all .2s;
}

.cc:hover {
  border-color: var(--rim2);
  transform: translateY(-3px);
  box-shadow: 0 12px 32px rgba(0, 0, 0, .4);
}

.cc-ico {
  font-size: 24px;
  flex-shrink: 0;
  width: 48px;
  height: 48px;
  background: rgba(232, 160, 32, .09);
  border: 1px solid rgba(232, 160, 32, .18);
  border-radius: 13px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.cc-body small {
  display: block;
  font-size: 10.5px;
  color: var(--fog);
  letter-spacing: .1em;
  text-transform: uppercase;
  margin-bottom: 2px;
}

.cc-body strong {
  display: block;
  font-size: 12.5px;
  font-weight: 600;
  color: var(--cream);
  margin-bottom: 2px;
  word-break: break-all;
}

.cc-body span {
  font-size: 11.5px;
  color: var(--gold);
}

/* CONTACT GRID */
.contact-grid {
  display: grid;
  grid-template-columns: 1.2fr 1fr;
  gap: 28px;
}

/* FORM */
.form-wrap {
  background: var(--slate);
  border: 1px solid var(--rim);
  border-radius: 22px;
  padding: 38px;
}

.success {
  text-align: center;
  padding: 44px 0;
}

.suc-ico {
  font-size: 52px;
  display: block;
  margin-bottom: 18px;
}

.success h3 {
  font-family: 'Cormorant Garamond', 'Playfair Display', serif;
  font-size: 1.75rem;
  margin-bottom: 9px;
}

.success p {
  color: var(--fog);
  margin-bottom: 22px;
}

.form-title {
  font-family: 'Cormorant Garamond', 'Playfair Display', serif;
  font-size: 1.4rem;
  font-weight: 800;
  margin-bottom: 26px;
}

form {
  display: flex;
  flex-direction: column;
  gap: 16px;
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
}

.fg label {
  font-size: 12.5px;
  font-weight: 500;
  color: var(--fog);
}

.fg input,
.fg select,
.fg textarea {
  background: var(--panel);
  border: 1px solid var(--rim);
  color: var(--cream);
  font-family: 'DM Sans', system-ui, sans-serif;
  font-size: 13.5px;
  padding: 12px 15px;
  border-radius: 11px;
  outline: none;
  transition: border-color .2s, box-shadow .2s;
}

.fg input:focus,
.fg select:focus,
.fg textarea:focus {
  border-color: var(--gold);
  box-shadow: 0 0 0 3px rgba(232, 160, 32, .12);
}

.fg input::placeholder,
.fg textarea::placeholder {
  color: var(--mist);
}

.fg select option {
  background: var(--slate);
}

.fg textarea {
  resize: vertical;
  min-height: 96px;
}

.fg.err input,
.fg.err select,
.fg.err textarea {
  border-color: #F87171;
}

.em {
  font-size: 11.5px;
  color: #F87171;
}

.sub-err {
  color: #F87171;
  font-size: 12.5px;
}

.btn-gold {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  background: linear-gradient(135deg, var(--gold), var(--gold-dim));
  color: #fff;
  font-weight: 700;
  font-size: 14.5px;
  padding: 14px 26px;
  border-radius: 50px;
  border: none;
  cursor: pointer;
  text-decoration: none;
  box-shadow: 0 5px 20px rgba(232, 160, 32, .38);
  transition: all .2s;
  width: 100%;
}

.btn-gold:hover:not(:disabled) {
  transform: translateY(-2px);
  box-shadow: 0 10px 28px rgba(232, 160, 32, .52);
}

.btn-gold:disabled {
  opacity: .45;
  cursor: not-allowed;
}

.btn-gold svg {
  width: 16px;
  height: 16px;
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

/* INFO COLUMN */
.info-col {
  display: flex;
  flex-direction: column;
  gap: 18px;
}

.info-card {
  background: var(--slate);
  border: 1px solid var(--rim);
  border-radius: 18px;
  padding: 26px;
}

.info-card h4 {
  font-family: 'Cormorant Garamond', 'Playfair Display', serif;
  font-size: 1.05rem;
  font-weight: 700;
  margin-bottom: 17px;
  display: flex;
  align-items: center;
  gap: 9px;
}

/* HOURS */
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

.h-row span:first-child {
  color: var(--fog);
}

.h-row.today span:first-child {
  color: var(--gold-lt);
  font-weight: 600;
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
  margin-left: 7px;
  letter-spacing: .05em;
}

/* MAP */
.map-box {
  background: var(--panel);
  border: 1px solid var(--rim);
  border-radius: 13px;
  height: 110px;
  display: flex;
  align-items: center;
  justify-content: center;
  position: relative;
  overflow: hidden;
  margin-bottom: 15px;
}

.map-box::before {
  content: '';
  position: absolute;
  inset: 0;
  background: radial-gradient(circle at 50% 50%, rgba(232, 160, 32, .07), transparent 65%);
}

.map-pin {
  font-size: 30px;
  position: relative;
  z-index: 1;
  animation: mpin 2s ease-in-out infinite;
}

@keyframes mpin {

  0%,
  100% {
    transform: translateY(0)
  }

  50% {
    transform: translateY(-7px)
  }
}

.map-ripple {
  position: absolute;
  width: 55px;
  height: 55px;
  border-radius: 50%;
  border: 1.5px solid rgba(232, 160, 32, .25);
  animation: mripple 2s ease infinite;
}

@keyframes mripple {
  0% {
    transform: scale(.5);
    opacity: 1
  }

  100% {
    transform: scale(2);
    opacity: 0
  }
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

/* FAQ */
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
  padding: 12px 0;
  cursor: pointer;
  text-align: left;
}

.faq-q svg {
  width: 15px;
  height: 15px;
  flex-shrink: 0;
  color: var(--fog);
}

.faq-a {
  font-size: 12.5px;
  color: var(--fog);
  line-height: 1.65;
  padding-bottom: 11px;
}

@media(max-width:1024px) {
  .contact-cards {
    grid-template-columns: repeat(2, 1fr);
  }

  .contact-grid {
    grid-template-columns: 1fr;
  }
}

@media(max-width:768px) {
  .section {
    padding: 52px 0;
  }

  .contact-cards {
    grid-template-columns: 1fr 1fr;
  }

  .form-wrap {
    padding: 24px 18px;
  }

  .form-row {
    grid-template-columns: 1fr;
  }
}

@media(max-width:480px) {
  .contact-cards {
    grid-template-columns: 1fr;
  }
}
</style>

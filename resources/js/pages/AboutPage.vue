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
          <span>About Us</span>
        </div>
        <h1 v-obs>Our <em class="accent">Story</em></h1>
        <p v-obs>18+ years of excellence in garment care — built on trust, quality, and customer love.</p>
      </div>
    </div>

    <!-- STORY -->
    <section class="section">
      <div class="container story-grid">
        <div class="story-left" v-obs>
          <p class="sec-tag">Who We Are</p>
          <h2>Saharanpur's Most <em class="accent">Trusted</em> Dry Cleaners</h2>
          <p>Chauhan DryCleaners was founded in 2005 by Sunil Chauhan with a simple belief: every garment deserves
            expert care. What started as a small neighbourhood dry cleaning shop has grown into one of
            Uttar Pradesh's most trusted garment care destinations.</p>
          <p>Today, our family-run business serves thousands of happy customers across Saharanpur and the surrounding
            region — providing premium garment care with the warmth and personal touch that only a family business
            can offer.</p>
          <p>We've invested in the latest cleaning technology, hired and trained expert professionals, and built systems
            to ensure every garment — from your everyday shirt to your priceless wedding lehenga — receives the
            individual attention it deserves.</p>
          <div class="address-box" v-obs>
            <span class="addr-ico">📍</span>
            <div>
              <strong>Visit Us</strong>
              <p>2, Khumran Pul Road, Nawabganj Khaaran,<br />Saharanpur, UP 247001</p>
            </div>
          </div>
        </div>
        <div class="story-right" v-obs>
          <div class="year-card">
            <div class="yc-shine"></div>
            <div class="yc-label">Since</div>
            <div class="yc-year">2005</div>
            <div class="yc-sub">Serving Saharanpur with pride</div>
          </div>
          <div class="s-stat ss1"><strong>18+</strong><span>Years</span></div>
          <div class="s-stat ss2"><strong>5K+</strong><span>Customers</span></div>
          <div class="s-stat ss3"><strong>50K+</strong><span>Garments</span></div>
        </div>
      </div>
    </section>

    <!-- FOUNDER SPOTLIGHT -->
    <section class="section bg-abyss">
      <div class="container">
        <div class="sec-head" v-obs>
          <p class="sec-tag">Our Founder</p>
          <h2>The Man Behind <em class="accent">The Vision</em></h2>
        </div>
        <div class="founder-card" v-obs>
          <div class="founder-portrait">
            <div class="fp-ring"></div>
            <div class="fp-av">SC</div>
            <div class="fp-badge">Founder</div>
          </div>
          <div class="founder-info">
            <h3>Mr. Sunil Chauhan</h3>
            <p class="founder-title">Founder &amp; Owner, Chauhan DryCleaners</p>
            <p>With over 25 years of hands-on experience in the textile care industry, Mr. Sunil Chauhan established
              Chauhan DryCleaners in 2005 with a singular vision — to bring truly professional, premium-quality garment
              care to the people of Saharanpur. His deep knowledge of fabrics, cleaning chemistry, and customer service
              has been the cornerstone of the business's growth and reputation.</p>
            <p>Under his leadership, Chauhan DryCleaners has transformed from a single neighbourhood shop into the
              region's most trusted name in garment care — known for treating every piece of clothing with the same
              care and precision it deserves.</p>
            <div class="founder-stats">
              <div class="fs-item"><strong>25+</strong><span>Years Experience</span></div>
              <div class="fs-item"><strong>2005</strong><span>Founded</span></div>
              <div class="fs-item"><strong>50K+</strong><span>Garments Cared</span></div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- VALUES -->
    <section class="section">
      <div class="container">
        <div class="sec-head" v-obs>
          <p class="sec-tag">Our Values</p>
          <h2>What <em class="accent">Drives Us</em></h2>
          <p class="sec-sub">Every decision we make is guided by these core principles.</p>
        </div>
        <div class="values-grid">
          <div v-for="(v, i) in values" :key="v.title" class="val-card" v-obs :style="{ '--d': i * 0.09 + 's' }">
            <div class="val-glow"></div>
            <span class="val-ico">{{ v.icon }}</span>
            <h3>{{ v.title }}</h3>
            <p>{{ v.desc }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- TEAM -->
    <section class="section bg-abyss">
      <div class="container">
        <div class="sec-head" v-obs>
          <p class="sec-tag">Our Team</p>
          <h2>The People Behind <em class="accent">Your Clean Clothes</em></h2>
        </div>
        <div class="team-grid">
          <div v-for="(m, i) in team" :key="m.name" class="team-card" v-obs :style="{ '--d': i * 0.09 + 's' }">
            <div class="tc-portrait" :class="m.portraitClass">
              <div class="tc-av">{{m.name.split(' ').map(n => n[0]).join('').slice(0, 2)}}</div>
            </div>
            <h4>{{ m.name }}</h4>
            <p class="tc-role">{{ m.role }}</p>
            <p class="tc-desc">{{ m.desc }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- DROP-OFF & EXPRESS CARE -->
    <section class="section">
      <div class="container">
        <div class="sec-head" v-obs>
          <p class="sec-tag">Our Service</p>
          <h2>Drop-Off &amp; <em class="accent">Express Care</em></h2>
          <p class="sec-sub">Bring your garments to us and experience the Chauhan difference — personally.</p>
        </div>
        <div class="dropoff-grid">
          <div v-for="(s, i) in dropoffSteps" :key="s.title" class="do-card" v-obs :style="{ '--d': i * 0.1 + 's' }">
            <div class="do-num">{{ String(i + 1).padStart(2, '0') }}</div>
            <span class="do-ico">{{ s.icon }}</span>
            <h3>{{ s.title }}</h3>
            <p>{{ s.desc }}</p>
          </div>
        </div>
        <div class="do-visit-banner" v-obs>
          <span class="do-banner-ico">📍</span>
          <div>
            <strong>Visit our store directly</strong>
            <p>2, Khumran Pul Road, Nawabganj Khaaran, Saharanpur, UP 247001</p>
          </div>
          <router-link to="/contact" class="btn-gold do-btn">Get Directions</router-link>
        </div>
      </div>
    </section>

    <!-- CTA -->
    <div class="about-cta" v-obs>
      <div class="cta-glow"></div>
      <div class="container about-cta-inner">
        <h2>Ready to Experience the Difference?</h2>
        <p>Join thousands of happy customers who trust Chauhan DryCleaners.</p>
        <div class="cta-btns">
          <router-link to="/contact" class="btn-gold">Visit Our Store</router-link>
          <router-link to="/contact" class="btn-ghost">Contact Us</router-link>
        </div>
      </div>
    </div>

  </div>
</template>

<script setup>
const vObs = {
  mounted(el) {
    const d = el.style.getPropertyValue('--d') || '0s'
    el.style.cssText += `opacity:0;transform:translateY(26px);transition:opacity .65s ease ${d},transform .65s ease ${d};`
    const io = new IntersectionObserver(([e]) => {
      if (e.isIntersecting) { el.style.opacity = '1'; el.style.transform = 'translateY(0)'; io.disconnect() }
    }, { threshold: 0.08 })
    io.observe(el)
  }
}

const values = [
  { icon: '🏆', title: 'Excellence First', desc: 'We never compromise on quality. Every garment is treated with the highest standards and individual attention.' },
  { icon: '🤝', title: 'Customer Trust', desc: 'Your satisfaction is our mission. We stand behind every service with our 100% satisfaction guarantee.' },
  { icon: '🌿', title: 'Eco-Conscious', desc: 'We use biodegradable, eco-friendly cleaning solvents that are gentle on your clothes and the planet.' },
  { icon: '⚡', title: 'Reliability', desc: 'Punctual service and consistent quality — every single time, without fail.' },
  { icon: '🔬', title: 'Innovation', desc: 'We continuously upgrade our technology and training to offer the most advanced garment care available.' },
  { icon: '❤️', title: 'Community', desc: 'Proud to serve Saharanpur for 18+ years. This city is our home and its people are our inspiration.' },
]

const team = [
  {
    name: 'Sunil Chauhan',
    role: 'Founder & Owner',
    desc: 'With 25+ years in the textile care industry, Sunil founded Chauhan DryCleaners with a vision of bringing premium quality garment care to Saharanpur.',
    portraitClass: 'portrait-gold'
  },
  {
    name: 'Poonam Chauhan',
    role: 'Co-Owner & Operations Head',
    desc: 'Poonam manages daily operations, quality control, and customer experience — ensuring every garment leaves perfectly cared for with a personal touch.',
    portraitClass: 'portrait-teal'
  },
]

const dropoffSteps = [
  {
    icon: '🧺',
    title: 'Bring Your Garments',
    desc: 'Walk into our store at Nawabganj Khaaran with your garments. Our team will greet you warmly and inspect each item.'
  },
  {
    icon: '🔍',
    title: 'Free Garment Inspection',
    desc: 'We carefully examine every piece for stains, fabric type, and any special care requirements before quoting a price.'
  },
  {
    icon: '✨',
    title: 'Expert Cleaning',
    desc: 'Your garments are cleaned using professional-grade equipment and eco-friendly solvents suited to each fabric.'
  },
  {
    icon: '📦',
    title: 'Ready for Collection',
    desc: 'We notify you when your clothes are ready. Collect them at your convenience — fresh, clean, and perfectly pressed.'
  },
]
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
  padding: 96px 0;
}

.bg-abyss {
  background: var(--abyss);
}

.accent {
  color: var(--gold);
  font-style: normal;
}

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
  width: 26px;
  height: 1px;
  background: var(--gold);
  opacity: .4;
}

.sec-head {
  text-align: center;
  margin-bottom: 64px;
}

.sec-head h2 {
  font-family: 'Cormorant Garamond', 'Playfair Display', serif;
  font-size: clamp(2rem, 4vw, 3rem);
  font-weight: 800;
  line-height: 1.1;
  margin-bottom: 15px;
}

.sec-sub {
  color: var(--fog);
  font-size: 15px;
  max-width: 500px;
  margin: 0 auto;
  line-height: 1.8;
}

/* PAGE HERO */
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

/* STORY */
.story-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 80px;
  align-items: center;
}

.story-left .sec-tag {
  justify-content: flex-start;
}

.story-left .sec-tag::before {
  display: none;
}

.story-left h2 {
  font-family: 'Cormorant Garamond', 'Playfair Display', serif;
  font-size: clamp(1.9rem, 3.2vw, 2.6rem);
  font-weight: 800;
  margin-bottom: 20px;
}

.story-left p {
  color: var(--fog);
  font-size: 14.5px;
  line-height: 1.85;
  margin-bottom: 15px;
}

.address-box {
  display: flex;
  align-items: flex-start;
  gap: 14px;
  background: var(--slate);
  border: 1px solid var(--rim2);
  border-radius: 14px;
  padding: 18px 20px;
  margin-top: 24px;
}

.addr-ico {
  font-size: 22px;
  flex-shrink: 0;
  margin-top: 2px;
}

.address-box strong {
  display: block;
  font-size: 13px;
  font-weight: 700;
  color: var(--gold);
  margin-bottom: 5px;
  letter-spacing: .06em;
  text-transform: uppercase;
}

.address-box p {
  font-size: 13.5px !important;
  color: var(--fog);
  line-height: 1.7 !important;
  margin-bottom: 0 !important;
}

.story-right {
  position: relative;
  padding: 24px;
}

.year-card {
  background: var(--slate);
  border: 1px solid rgba(232, 160, 32, .18);
  border-radius: 22px;
  padding: 40px;
  text-align: center;
  position: relative;
  overflow: hidden;
}

.yc-shine {
  position: absolute;
  inset: 0;
  background: radial-gradient(circle at 50% 0%, rgba(232, 160, 32, .08), transparent 60%);
  pointer-events: none;
}

.yc-label {
  font-size: 13px;
  font-weight: 600;
  color: var(--gold);
  letter-spacing: .18em;
  text-transform: uppercase;
  margin-bottom: 8px;
}

.yc-year {
  font-family: 'Cormorant Garamond', 'Playfair Display', serif;
  font-size: 5rem;
  font-weight: 900;
  color: var(--cream);
  line-height: 1;
}

.yc-sub {
  font-size: 13.5px;
  color: var(--fog);
  margin-top: 12px;
}

.s-stat {
  position: absolute;
  background: var(--panel);
  border: 1px solid var(--rim);
  border-radius: 13px;
  padding: 13px 16px;
  text-align: center;
  box-shadow: 0 14px 34px rgba(0, 0, 0, .5);
}

.s-stat strong {
  display: block;
  font-family: 'Cormorant Garamond', 'Playfair Display', serif;
  font-size: 1.55rem;
  font-weight: 800;
  color: var(--gold);
}

.s-stat span {
  font-size: 10.5px;
  color: var(--fog);
  text-transform: uppercase;
  letter-spacing: .1em;
}

.ss1 {
  top: -10px;
  right: -10px;
}

.ss2 {
  bottom: 18px;
  left: -20px;
}

.ss3 {
  bottom: -10px;
  right: 16px;
}

/* FOUNDER SPOTLIGHT */
.founder-card {
  display: grid;
  grid-template-columns: 280px 1fr;
  gap: 64px;
  align-items: center;
  background: var(--slate);
  border: 1px solid var(--rim2);
  border-radius: 26px;
  padding: 52px;
}

.founder-portrait {
  position: relative;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 16px;
}

.fp-ring {
  position: absolute;
  width: 180px;
  height: 180px;
  border-radius: 50%;
  border: 2px solid rgba(232, 160, 32, .22);
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}

.fp-av {
  width: 150px;
  height: 150px;
  border-radius: 50%;
  background: linear-gradient(135deg, var(--gold), #b36a00);
  display: flex;
  align-items: center;
  justify-content: center;
  font-family: 'Cormorant Garamond', serif;
  font-size: 3rem;
  font-weight: 800;
  color: #fff;
  position: relative;
  z-index: 1;
  border: 3px solid rgba(232, 160, 32, .35);
}

.fp-badge {
  background: linear-gradient(135deg, var(--gold), var(--gold-dim));
  color: #fff;
  font-size: 10.5px;
  font-weight: 700;
  letter-spacing: .18em;
  text-transform: uppercase;
  padding: 5px 14px;
  border-radius: 50px;
  position: relative;
  z-index: 1;
}

.founder-info h3 {
  font-family: 'Cormorant Garamond', 'Playfair Display', serif;
  font-size: clamp(1.8rem, 2.8vw, 2.4rem);
  font-weight: 800;
  margin-bottom: 6px;
}

.founder-title {
  font-size: 12.5px;
  font-weight: 600;
  color: var(--gold);
  letter-spacing: .1em;
  text-transform: uppercase;
  margin-bottom: 22px;
}

.founder-info p {
  color: var(--fog);
  font-size: 14.5px;
  line-height: 1.85;
  margin-bottom: 14px;
}

.founder-stats {
  display: flex;
  gap: 28px;
  margin-top: 28px;
  padding-top: 24px;
  border-top: 1px solid var(--rim);
}

.fs-item {
  display: flex;
  flex-direction: column;
}

.fs-item strong {
  font-family: 'Cormorant Garamond', serif;
  font-size: 1.8rem;
  font-weight: 800;
  color: var(--gold);
  line-height: 1;
}

.fs-item span {
  font-size: 11px;
  color: var(--fog);
  text-transform: uppercase;
  letter-spacing: .1em;
  margin-top: 5px;
}

/* VALUES */
.values-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 18px;
}

.val-card {
  background: var(--slate);
  border: 1px solid var(--rim);
  border-radius: 19px;
  padding: 30px;
  position: relative;
  overflow: hidden;
  transition: all .3s;
}

.val-card:hover {
  transform: translateY(-4px);
  border-color: var(--rim2);
  box-shadow: 0 18px 44px rgba(0, 0, 0, .4);
}

.val-glow {
  position: absolute;
  inset: 0;
  background: radial-gradient(circle at 50% -10%, rgba(232, 160, 32, .06), transparent 55%);
  opacity: 0;
  transition: opacity .3s;
  pointer-events: none;
}

.val-card:hover .val-glow {
  opacity: 1;
}

.val-ico {
  font-size: 34px;
  margin-bottom: 16px;
  display: block;
}

.val-card h3 {
  font-family: 'Cormorant Garamond', 'Playfair Display', serif;
  font-size: 1.1rem;
  font-weight: 700;
  margin-bottom: 9px;
}

.val-card p {
  color: var(--fog);
  font-size: 13.5px;
  line-height: 1.7;
}

/* TEAM */
.team-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 18px;
}

.team-card {
  background: var(--slate);
  border: 1px solid var(--rim);
  border-radius: 19px;
  padding: 26px;
  text-align: center;
  transition: all .3s;
}

.team-card:hover {
  transform: translateY(-4px);
  border-color: var(--rim2);
}

.tc-portrait {
  width: 72px;
  height: 72px;
  border-radius: 50%;
  margin: 0 auto 15px;
  display: flex;
  align-items: center;
  justify-content: center;
  position: relative;
}

.portrait-gold {
  background: linear-gradient(135deg, var(--gold), #b36a00);
  border: 3px solid rgba(232, 160, 32, .35);
}

.portrait-teal {
  background: linear-gradient(135deg, var(--teal-lt), var(--teal));
  border: 3px solid rgba(14, 165, 160, .35);
}

.portrait-slate {
  background: linear-gradient(135deg, #3a4a60, #1A2333);
  border: 3px solid var(--rim);
}

.tc-av {
  font-family: 'Cormorant Garamond', serif;
  font-weight: 800;
  font-size: 1.4rem;
  color: #fff;
}

.team-card h4 {
  font-weight: 700;
  font-size: 14.5px;
  margin-bottom: 4px;
}

.tc-role {
  font-size: 11.5px;
  font-weight: 600;
  color: var(--gold);
  letter-spacing: .05em;
  text-transform: uppercase;
  margin-bottom: 10px;
}

.tc-desc {
  color: var(--fog);
  font-size: 12.5px;
  line-height: 1.65;
}

/* DROP-OFF & EXPRESS CARE */
.dropoff-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 18px;
  margin-bottom: 40px;
}

.do-card {
  background: var(--slate);
  border: 1px solid var(--rim);
  border-radius: 19px;
  padding: 30px 24px;
  position: relative;
  overflow: hidden;
  transition: all .3s;
}

.do-card:hover {
  transform: translateY(-4px);
  border-color: var(--rim2);
}

.do-num {
  font-family: 'Cormorant Garamond', serif;
  font-size: 3rem;
  font-weight: 900;
  color: rgba(232, 160, 32, .12);
  line-height: 1;
  margin-bottom: 6px;
}

.do-ico {
  font-size: 28px;
  display: block;
  margin-bottom: 14px;
}

.do-card h3 {
  font-family: 'Cormorant Garamond', 'Playfair Display', serif;
  font-size: 1.05rem;
  font-weight: 700;
  margin-bottom: 9px;
}

.do-card p {
  color: var(--fog);
  font-size: 13px;
  line-height: 1.7;
}

.do-visit-banner {
  background: var(--slate);
  border: 1px solid var(--rim2);
  border-radius: 16px;
  padding: 22px 28px;
  display: flex;
  align-items: center;
  gap: 18px;
}

.do-banner-ico {
  font-size: 28px;
  flex-shrink: 0;
}

.do-visit-banner strong {
  display: block;
  font-size: 14px;
  font-weight: 700;
  margin-bottom: 4px;
  color: var(--cream);
}

.do-visit-banner p {
  font-size: 13px;
  color: var(--fog);
}

.do-btn {
  margin-left: auto;
  white-space: nowrap;
  flex-shrink: 0;
}

/* ABOUT CTA */
.about-cta {
  background: var(--slate);
  border-top: 1px solid var(--rim);
  border-bottom: 1px solid var(--rim);
  padding: 80px 0;
  text-align: center;
  position: relative;
  overflow: hidden;
}

.cta-glow {
  position: absolute;
  top: -80px;
  left: 50%;
  transform: translateX(-50%);
  width: 560px;
  height: 280px;
  background: radial-gradient(ellipse, rgba(232, 160, 32, .07) 0%, transparent 70%);
  pointer-events: none;
}

.about-cta-inner {
  position: relative;
  z-index: 1;
}

.about-cta-inner h2 {
  font-family: 'Cormorant Garamond', 'Playfair Display', serif;
  font-size: clamp(1.8rem, 3.5vw, 2.8rem);
  font-weight: 800;
  margin-bottom: 11px;
}

.about-cta-inner p {
  color: var(--fog);
  font-size: 16px;
  margin-bottom: 30px;
}

.cta-btns {
  display: flex;
  gap: 14px;
  justify-content: center;
  flex-wrap: wrap;
}

.btn-gold {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  background: linear-gradient(135deg, var(--gold), var(--gold-dim));
  color: #fff;
  font-weight: 700;
  font-size: 14.5px;
  padding: 13px 27px;
  border-radius: 50px;
  text-decoration: none;
  box-shadow: 0 5px 20px rgba(232, 160, 32, .38);
  transition: all .2s;
}

.btn-gold:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 28px rgba(232, 160, 32, .52);
}

.btn-ghost {
  display: inline-flex;
  align-items: center;
  border: 1px solid rgba(242, 237, 228, .12);
  color: var(--cream);
  font-weight: 500;
  font-size: 14.5px;
  padding: 13px 27px;
  border-radius: 50px;
  text-decoration: none;
  transition: all .2s;
}

.btn-ghost:hover {
  border-color: var(--gold);
  color: var(--gold-lt);
  background: var(--gold-glow);
}

/* RESPONSIVE */
@media(max-width:1024px) {
  .story-grid {
    grid-template-columns: 1fr;
    gap: 48px;
  }

  .story-right {
    display: none;
  }

  .founder-card {
    grid-template-columns: 1fr;
    gap: 36px;
    text-align: center;
    padding: 36px 28px;
  }

  .founder-portrait {
    margin: 0 auto;
  }

  .founder-stats {
    justify-content: center;
  }

  .values-grid {
    grid-template-columns: repeat(2, 1fr);
  }

  .team-grid {
    grid-template-columns: repeat(2, 1fr);
  }

  .dropoff-grid {
    grid-template-columns: repeat(2, 1fr);
  }

  .do-visit-banner {
    flex-wrap: wrap;
  }

  .do-btn {
    margin-left: 0;
    width: 100%;
    justify-content: center;
  }
}

@media(max-width:768px) {
  .section {
    padding: 64px 0;
  }

  .values-grid {
    grid-template-columns: 1fr;
  }

  .team-grid {
    grid-template-columns: 1fr 1fr;
  }

  .dropoff-grid {
    grid-template-columns: 1fr;
  }
}

@media(max-width:480px) {
  .team-grid {
    grid-template-columns: 1fr;
  }
}
</style>
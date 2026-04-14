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
          <h2>Ludhiana's Most <em class="accent">Trusted</em> Dry Cleaners</h2>
          <p>Chauhan DryCleaners was founded in 2005 by Ramesh Chauhan with a simple belief: every garment deserves
            expert care. What started as a small neighbourhood dry cleaning shop in Civil Lines has grown into one of
            Punjab's most trusted garment care destinations.</p>
          <p>Today, our family-run business serves thousands of happy customers across Ludhiana, Jalandhar, and
            Chandigarh — providing premium garment care with the warmth and personal touch that only a family business
            can offer.</p>
          <p>We've invested in the latest cleaning technology, hired and trained expert professionals, and built systems
            to ensure every garment — from your everyday shirt to your priceless wedding lehenga — receives the
            individual attention it deserves.</p>
        </div>
        <div class="story-right" v-obs>
          <div class="year-card">
            <div class="yc-shine"></div>
            <div class="yc-label">Since</div>
            <div class="yc-year">2005</div>
            <div class="yc-sub">Serving Ludhiana with pride</div>
          </div>
          <div class="s-stat ss1"><strong>18+</strong><span>Years</span></div>
          <div class="s-stat ss2"><strong>5K+</strong><span>Customers</span></div>
          <div class="s-stat ss3"><strong>50K+</strong><span>Garments</span></div>
        </div>
      </div>
    </section>

    <!-- VALUES -->
    <section class="section bg-abyss">
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
    <section class="section">
      <div class="container">
        <div class="sec-head" v-obs>
          <p class="sec-tag">Our Team</p>
          <h2>The People Behind <em class="accent">Your Clean Clothes</em></h2>
        </div>
        <div class="team-grid">
          <div v-for="(m, i) in team" :key="m.name" class="team-card" v-obs :style="{ '--d': i * 0.09 + 's' }">
            <div class="tc-av">{{ m.name[0] }}</div>
            <h4>{{ m.name }}</h4>
            <p class="tc-role">{{ m.role }}</p>
            <p class="tc-desc">{{ m.desc }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- CERTS -->
    <section class="section bg-abyss">
      <div class="container">
        <div class="sec-head" v-obs>
          <p class="sec-tag">Recognition</p>
          <h2>Awards &amp; <em class="accent">Certifications</em></h2>
        </div>
        <div class="certs-grid">
          <div v-for="c in certs" :key="c.title" class="cert-card" v-obs>
            <span class="cert-ico">{{ c.icon }}</span>
            <div>
              <h4>{{ c.title }}</h4>
              <p>{{ c.year }}</p>
            </div>
          </div>
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
          <router-link to="/booking" class="btn-gold">Book Free Pickup</router-link>
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
  { icon: '⚡', title: 'Reliability', desc: 'Punctual pickup, on-time delivery, and consistent quality — every single time, without fail.' },
  { icon: '🔬', title: 'Innovation', desc: 'We continuously upgrade our technology and training to offer the most advanced garment care available.' },
  { icon: '❤️', title: 'Community', desc: 'Proud to serve Ludhiana for 18+ years. This city is our home and its people are our inspiration.' },
]

const team = [
  { name: 'Ramesh Chauhan', role: 'Founder & Owner', desc: 'With 25+ years in the textile care industry, Ramesh founded Chauhan DryCleaners with a vision of bringing premium quality care to Ludhiana.' },
  { name: 'Sunita Chauhan', role: 'Operations Manager', desc: 'Sunita oversees daily operations, quality control, and customer experience — ensuring every garment leaves perfectly cared for.' },
  { name: 'Amit Sharma', role: 'Head Technician', desc: 'Amit leads our team of trained professionals and specializes in bridal and luxury outfit restoration.' },
  { name: 'Priya Verma', role: 'Customer Relations', desc: 'Priya manages all customer inquiries, bookings, and ensures every client receives prompt, courteous service.' },
]

const certs = [
  { icon: '🏅', title: 'Best Dry Cleaner, Ludhiana 2022', year: 'City Business Awards 2022' },
  { icon: '🌟', title: 'Top-Rated Service Provider', year: 'Google Reviews – 4.9★ (500+ reviews)' },
  { icon: '✅', title: 'ISO 9001:2015 Certified', year: 'Quality Management System' },
  { icon: '🌿', title: 'Eco-Friendly Business Certification', year: 'Punjab Green Business Initiative' },
  { icon: '🏆', title: '5-Star Customer Satisfaction', year: 'Punjab Retail Excellence Awards 2021' },
  { icon: '🔒', title: 'Trusted Local Business Badge', year: 'Ludhiana Chamber of Commerce' },
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
  grid-template-columns: repeat(4, 1fr);
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

.tc-av {
  width: 60px;
  height: 60px;
  border-radius: 50%;
  background: linear-gradient(135deg, var(--gold), var(--teal));
  display: flex;
  align-items: center;
  justify-content: center;
  font-family: 'Cormorant Garamond', serif;
  font-weight: 800;
  font-size: 1.4rem;
  color: #fff;
  margin: 0 auto 15px;
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

/* CERTS */
.certs-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 14px;
}

.cert-card {
  display: flex;
  align-items: center;
  gap: 15px;
  background: var(--slate);
  border: 1px solid var(--rim);
  border-radius: 14px;
  padding: 19px 22px;
  transition: all .2s;
}

.cert-card:hover {
  border-color: var(--rim2);
}

.cert-ico {
  font-size: 26px;
  flex-shrink: 0;
}

.cert-card h4 {
  font-size: 13.5px;
  font-weight: 600;
  margin-bottom: 3px;
}

.cert-card p {
  font-size: 11.5px;
  color: var(--fog);
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

@media(max-width:1024px) {
  .story-grid {
    grid-template-columns: 1fr;
    gap: 48px;
  }

  .story-right {
    display: none;
  }

  .values-grid {
    grid-template-columns: repeat(2, 1fr);
  }

  .team-grid {
    grid-template-columns: repeat(2, 1fr);
  }

  .certs-grid {
    grid-template-columns: repeat(2, 1fr);
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

  .certs-grid {
    grid-template-columns: 1fr;
  }
}

@media(max-width:480px) {
  .team-grid {
    grid-template-columns: 1fr;
  }
}
</style>

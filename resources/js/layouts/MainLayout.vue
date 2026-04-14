<template>
  <div class="root">

    <!-- ── TOP CONTACT STRIP ── -->
    <div class="strip">
      <div class="strip-inner">
        <div class="strip-left">
          <a href="tel:+918534837704" class="sl">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 8.81 19.79 19.79 0 01.02 2.18 2 2 0 012 0h3a2 2 0 012 1.72c.13.96.36 1.9.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0122 14.9z"/></svg>
            +91 85348 37704
          </a>
          <span class="sdiv"></span>
          <a href="mailto:chauhandrycleaners05@gmail.com" class="sl">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M22 7l-10 7L2 7"/></svg>
            chauhandrycleaners05@gmail.com
          </a>
        </div>
        <div class="strip-right">
  <span class="sl nd">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round">
      <circle cx="12" cy="12" r="10"/>
      <polyline points="12 6 12 12 16 14"/>
    </svg>
    Mon–Wed &amp; Fri–Sun 10:30AM–9PM &nbsp;·&nbsp; Tue 10:30AM–1PM
  </span>
  <span class="sdiv"></span>
  <span class="open-badge" v-if="isOpenNow">
    <span class="open-dot"></span>
    Open Now
  </span>
  <span class="open-badge closed" v-else>
    <span class="open-dot"></span>
    Closed
  </span>
</div>
      </div>
    </div>

    <!-- ── NAVBAR ── -->
    <nav class="nav" :class="{ scrolled }">
      <div class="nav-inner">

        <!-- Brand -->
        <router-link to="/" class="brand">
          <div class="brand-icon">
            <span class="bi-letter">C</span>
            <svg class="bi-ring" viewBox="0 0 52 52" fill="none">
              <circle cx="26" cy="26" r="24" stroke="url(#rg)" stroke-width="1" stroke-dasharray="4 3" opacity="0.7"/>
              <defs><linearGradient id="rg" x1="0" y1="0" x2="52" y2="52" gradientUnits="userSpaceOnUse"><stop stop-color="#E8A020"/><stop offset="1" stop-color="#F5C842" stop-opacity="0.15"/></linearGradient></defs>
            </svg>
          </div>
          <div class="brand-words">
            <span class="bw-name">Chauhan</span>
            <span class="bw-sub">DryCleaners &nbsp;·&nbsp; Est. 2005</span>
          </div>
        </router-link>

        <!-- Desktop Links -->
        <div class="nav-links" :class="{ open: mopen }">
          <router-link
            v-for="l in links"
            :key="l.to"
            :to="l.to"
            class="nl"
            @click="mopen = false"
          >{{ l.label }}</router-link>
          <router-link to="/booking" class="nl-book" @click="mopen = false">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
            Book Pickup
          </router-link>
        </div>

        <!-- Hamburger -->
        <button class="burger" :class="{ active: mopen }" @click="mopen = !mopen" aria-label="Menu">
          <span></span><span></span><span></span>
        </button>

      </div>
    </nav>

    <!-- ── MAIN CONTENT ── -->
    <main class="page-content">
      <router-view v-slot="{ Component }">
        <transition name="pg" mode="out-in">
          <component :is="Component"/>
        </transition>
      </router-view>
    </main>

    <!-- ── FOOTER ── -->
    <footer class="foot">
      <div class="foot-bg"></div>
      <div class="foot-mesh"></div>
      <div class="wrap foot-body">
        <div class="fb-brand">
          <router-link to="/" class="brand" style="text-decoration:none">
            <div class="brand-icon sm"><span class="bi-letter">C</span></div>
            <div class="brand-words">
              <span class="bw-name">Chauhan</span>
              <span class="bw-sub">DryCleaners &nbsp;·&nbsp; Est. 2005</span>
            </div>
          </router-link>
          <p>Premium garment care you can trust. Proudly serving Ludhiana &amp; Punjab since 2005 with warmth, expertise, and precision.</p>
          <!-- <div class="fb-soc">
            <a href="#" class="soc-btn" title="Facebook"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg></a>
            <a href="#" class="soc-btn" title="Instagram"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg></a>
            <a href="#" class="soc-btn" title="WhatsApp"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"/></svg></a>
          </div> -->
        </div>
        <div class="fc">
          <h5>Navigate</h5>
          <router-link v-for="l in links" :key="l.to" :to="l.to">{{ l.label }}</router-link>
          <router-link to="/booking">Book Pickup</router-link>
        </div>
        <div class="fc">
          <h5>Services</h5>
          <span v-for="s in svcs" :key="s">{{ s }}</span>
        </div>
        <div class="fc">
          <h5>Reach Us</h5>
          <a href="tel:+918534837704" class="fci"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 8.81 19.79 19.79 0 01.02 2.18 2 2 0 012 0h3a2 2 0 012 1.72c.13.96.36 1.9.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0122 14.9z"/></svg> +91 8534837704</a>
          <a href="mailto:chauhandrycleaners05@gmail.com" class="fci"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M22 7l-10 7L2 7"/></svg> chauhandrycleaners05@gmail.com</a>
          <div class="fci nd"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg><span>2, Khumran Pul Road, Nawabganj,<br>Khaaran, Saharanpur, UP 247001</span></div>
        </div>
      </div>
      <div class="foot-bar">
        <div class="wrap foot-bar-row">
          <p>© {{ new Date().getFullYear() }} Chauhan DryCleaners. All rights reserved.</p>
          <div class="fbar-links"><a href="#">Privacy Policy</a><a href="#">Terms of Service</a></div>
        </div>
      </div>
    </footer>

  </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'

const scrolled = ref(false)
const mopen   = ref(false)
const links   = [
  { to: '/',         label: 'Home'     },
  { to: '/services', label: 'Services' },
  { to: '/about',    label: 'About Us' },
  { to: '/contact',  label: 'Contact'  },
]
const svcs = [
  'Clothes Washing','Dry Cleaning','Ironing & Pressing',
  'Blankets & Quilts','Wedding Outfit Care','Express Service',
]

// ── Open Now logic ──────────────────────────────────────────
const now = ref(new Date())
let clockTimer = null

// Schedule:
//   Tuesday  → 10:30 – 13:00  (half day)
//   All else → 10:30 – 21:00
const isOpenNow = computed(() => {
  const d   = now.value
  const day = d.getDay()          // 0 Sun … 6 Sat
  const min = d.getHours() * 60 + d.getMinutes()

  const open  = 10 * 60 + 30     // 10:30 → 630 min
  const closeNormal  = 21 * 60   // 21:00 → 1260 min
  const closeTuesday = 13 * 60   // 13:00 → 780 min

  const closeTime = (day === 2) ? closeTuesday : closeNormal
  return min >= open && min < closeTime
})

// ── Scroll handler ───────────────────────────────────────────
function onScroll() { scrolled.value = window.scrollY > 40 }

onMounted(() => {
  window.addEventListener('scroll', onScroll, { passive: true })
  // Refresh `now` every minute so the badge stays accurate
  clockTimer = setInterval(() => { now.value = new Date() }, 60_000)
})
onUnmounted(() => {
  window.removeEventListener('scroll', onScroll)
  clearInterval(clockTimer)
})
</script>

<style>
.open-badge.closed .open-dot {
  background: #ef4444;   /* red dot when closed */
  box-shadow: 0 0 0 3px rgba(239, 68, 68, .25);
  animation: none;
}
/* ══════════════════════════════════════════
   HARD RESET — override any inherited styles
   These are unscoped so they win everywhere
══════════════════════════════════════════ */
html, body, #app {
  background: #060911 !important;
  color: #F2EDE4 !important;
  margin: 0 !important;
  padding: 0 !important;
}
a { color: inherit; }
</style>

<style scoped>
/* ══════════════════════════════════════════
   DESIGN TOKENS
══════════════════════════════════════════ */
:root {
  --bg0:   #060911;   /* page base        */
  --bg1:   #0B1018;   /* strip / footer   */
  --bg2:   #111827;   /* nav / cards      */
  --bg3:   #1A2333;   /* elevated panels  */
  --line:  rgba(255,255,255,0.07);
  --lineA: rgba(232,160,32,0.22);
  --gold:  #E8A020;
  --goldL: #F5C842;
  --goldD: #7A4A00;
  --glow:  rgba(232,160,32,0.14);
  --teal:  #0EA5A0;
  --cr:    #F2EDE4;   /* cream text       */
  --muted: rgba(242,237,228,0.50);
  --dim:   rgba(242,237,228,0.26);
}

/* ── BASE ── */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

.root {
  background: var(--bg0);
  color: var(--cr);
  font-family: 'DM Sans', 'Outfit', system-ui, sans-serif;
  min-height: 100vh;
  overflow-x: hidden;
}

.wrap {
  max-width: 1240px;
  margin: 0 auto;
  padding: 0 28px;
}

/* ══════════════════════════════════════════
   TOP CONTACT STRIP
══════════════════════════════════════════ */
.strip {
  background: var(--bg1);
  border-bottom: 1px solid var(--line);
  position: relative;
  z-index: 1010;
}
.strip-inner {
  max-width: 1240px;
  margin: 0 auto;
  padding: 0 28px;
  height: 42px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 16px;
}
.strip-left,
.strip-right {
  display: flex;
  align-items: center;
  gap: 16px;
}
.sl {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  font-size: 12px;
  color: var(--muted);
  text-decoration: none;
  letter-spacing: 0.01em;
  white-space: nowrap;
  transition: color 0.2s;
}
.sl:not(.nd):hover { color: var(--goldL); }
.sl.nd { cursor: default; }
.sl svg { width: 12px; height: 12px; flex-shrink: 0; }
.sdiv {
  width: 1px;
  height: 14px;
  background: var(--line);
  flex-shrink: 0;
}
.open-badge {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 0.1em;
  text-transform: uppercase;
  color: #4ADE80;
}
.open-dot {
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #4ADE80;
  flex-shrink: 0;
  box-shadow: 0 0 6px rgba(74,222,128,0.85);
  position: relative;
}
.open-dot::after {
  content: '';
  position: absolute;
  inset: -3px;
  border-radius: 50%;
  border: 1px solid #4ADE80;
  animation: pdot 2.2s ease infinite;
}
@keyframes pdot {
  0%   { opacity: 0.8; transform: scale(1); }
  100% { opacity: 0;   transform: scale(2.4); }
}

/* ══════════════════════════════════════════
   NAVBAR
══════════════════════════════════════════ */
.nav {
  position: sticky;
  top: 0;
  z-index: 1000;
  height: 70px;
  background: rgba(6, 9, 17, 0.75);
  backdrop-filter: blur(28px) saturate(160%);
  -webkit-backdrop-filter: blur(28px) saturate(160%);
  border-bottom: 1px solid var(--line);
  transition: background 0.35s ease, box-shadow 0.35s ease;
}
.nav.scrolled {
  background: rgba(6, 9, 17, 0.97);
  box-shadow:
    0 1px 0 var(--lineA),
    0 4px 40px rgba(0,0,0,0.65);
}
.nav-inner {
  max-width: 1240px;
  margin: 0 auto;
  padding: 0 28px;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

/* ── Brand ── */
.brand {
  display: inline-flex;
  align-items: center;
  gap: 13px;
  text-decoration: none;
  flex-shrink: 0;
}
.brand-icon {
  position: relative;
  width: 46px;
  height: 46px;
  flex-shrink: 0;
}
.brand-icon.sm {
  width: 36px;
  height: 36px;
}
.bi-letter {
  position: absolute;
  inset: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  background: linear-gradient(145deg, #E8A020, #7A4A00);
  border-radius: 13px;
  font-family: 'Cormorant Garamond', 'Playfair Display', Georgia, serif;
  font-weight: 800;
  font-size: 22px;
  color: #fff;
  z-index: 1;
  box-shadow:
    0 4px 18px rgba(232,160,32,0.45),
    inset 0 1px 0 rgba(255,255,255,0.22);
  letter-spacing: -0.01em;
}
.brand-icon.sm .bi-letter {
  border-radius: 10px;
  font-size: 17px;
}
.bi-ring {
  position: absolute;
  inset: -5px;
  width: calc(100% + 10px);
  height: calc(100% + 10px);
  animation: ringrot 12s linear infinite;
}
@keyframes ringrot { to { transform: rotate(360deg); } }

.brand-words { display: flex; flex-direction: column; gap: 1px; }
.bw-name {
  font-family: 'Cormorant Garamond', 'Playfair Display', Georgia, serif;
  font-weight: 700;
  font-size: 19px;
  color: #F2EDE4;
  line-height: 1.05;
  letter-spacing: 0.01em;
  /* force cream no matter what */
  -webkit-text-fill-color: #F2EDE4;
}
.bw-sub {
  font-size: 9px;
  letter-spacing: 0.22em;
  text-transform: uppercase;
  color: #E8A020;
  font-weight: 600;
  -webkit-text-fill-color: #E8A020;
}

/* ── Nav Links ── */
.nav-links {
  display: flex;
  align-items: center;
  gap: 2px;
}
.nl {
  padding: 8px 15px;
  border-radius: 8px;
  font-size: 14px;
  font-weight: 500;
  color: rgba(242,237,228,0.55);
  text-decoration: none;
  white-space: nowrap;
  position: relative;
  transition: color 0.2s, background 0.2s;
  -webkit-text-fill-color: rgba(242,237,228,0.55);
}
.nl::after {
  content: '';
  position: absolute;
  bottom: 5px;
  left: 50%;
  transform: translateX(-50%) scaleX(0);
  width: 14px;
  height: 1.5px;
  border-radius: 1px;
  background: #E8A020;
  transition: transform 0.25s;
}
.nl:hover {
  color: #F2EDE4;
  background: rgba(255,255,255,0.05);
  -webkit-text-fill-color: #F2EDE4;
}
.nl.router-link-exact-active {
  color: #F5C842 !important;
  -webkit-text-fill-color: #F5C842 !important;
}
.nl.router-link-exact-active::after { transform: translateX(-50%) scaleX(1); }
.nl.router-link-active {
  color: #F2EDE4;
  -webkit-text-fill-color: #F2EDE4;
}

.nl-book {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin-left: 12px;
  padding: 10px 22px;
  border-radius: 50px;
  background: linear-gradient(135deg, #E8A020 0%, #7A4A00 100%);
  color: #fff !important;
  -webkit-text-fill-color: #fff !important;
  font-size: 13.5px;
  font-weight: 700;
  text-decoration: none;
  white-space: nowrap;
  box-shadow:
    0 4px 18px rgba(232,160,32,0.4),
    inset 0 1px 0 rgba(255,255,255,0.18);
  transition: transform 0.22s, box-shadow 0.22s;
}
.nl-book svg { width: 14px; height: 14px; flex-shrink: 0; }
.nl-book:hover {
  transform: translateY(-2px);
  box-shadow:
    0 8px 26px rgba(232,160,32,0.55),
    inset 0 1px 0 rgba(255,255,255,0.18);
}

/* ── Hamburger ── */
.burger {
  display: none;
  flex-direction: column;
  gap: 5px;
  background: none;
  border: none;
  cursor: pointer;
  padding: 8px;
  border-radius: 8px;
  transition: background 0.2s;
}
.burger:hover { background: rgba(255,255,255,0.06); }
.burger span {
  display: block;
  width: 22px;
  height: 2px;
  background: #F2EDE4;
  border-radius: 2px;
  transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
}
.burger.active span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
.burger.active span:nth-child(2) { opacity: 0; transform: scaleX(0); }
.burger.active span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }

/* ══════════════════════════════════════════
   PAGE TRANSITIONS
══════════════════════════════════════════ */
.page-content { min-height: calc(100vh - 42px - 70px); background: var(--bg0); }
.pg-enter-active, .pg-leave-active { transition: opacity 0.25s ease, transform 0.25s ease; }
.pg-enter-from { opacity: 0; transform: translateY(10px); }
.pg-leave-to   { opacity: 0; transform: translateY(-6px); }

/* ══════════════════════════════════════════
   FOOTER
══════════════════════════════════════════ */
.foot {
  background: var(--bg1);
  border-top: 1px solid var(--line);
  position: relative;
  overflow: hidden;
}
.foot-bg {
  position: absolute;
  top: -100px;
  left: 50%;
  transform: translateX(-50%);
  width: 700px;
  height: 350px;
  background: radial-gradient(ellipse, rgba(232,160,32,0.07) 0%, rgba(14,165,160,0.03) 55%, transparent 70%);
  pointer-events: none;
}
.foot-mesh {
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,0.012) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,0.012) 1px, transparent 1px);
  background-size: 64px 64px;
  pointer-events: none;
}
.foot-body {
  display: grid;
  grid-template-columns: 1.8fr 1fr 1fr 1.4fr;
  gap: 52px;
  padding-top: 64px;
  padding-bottom: 56px;
  position: relative;
  z-index: 1;
}
.fb-brand p {
  color: var(--muted);
  font-size: 13px;
  line-height: 1.85;
  margin-top: 18px;
  max-width: 240px;
}
.fb-soc {
  display: flex;
  gap: 10px;
  margin-top: 22px;
}
.soc-btn {
  width: 34px;
  height: 34px;
  border-radius: 9px;
  border: 1px solid var(--line);
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--muted);
  text-decoration: none;
  background: var(--bg2);
  transition: all 0.2s;
}
.soc-btn svg { width: 14px; height: 14px; }
.soc-btn:hover { border-color: var(--gold); color: var(--goldL); background: var(--glow); }

.fc h5 {
  font-family: 'Cormorant Garamond', 'Playfair Display', Georgia, serif;
  font-weight: 700;
  font-size: 14px;
  color: var(--cr);
  margin-bottom: 18px;
  letter-spacing: 0.04em;
}
.fc a, .fc span {
  display: block;
  color: var(--muted);
  font-size: 13px;
  text-decoration: none;
  padding: 5px 0;
  transition: color 0.2s;
  cursor: pointer;
}
.fc a:hover { color: var(--goldL); }

.fci {
  display: flex;
  align-items: flex-start;
  gap: 9px;
  color: var(--muted);
  font-size: 13px;
  text-decoration: none;
  padding: 6px 0;
  transition: color 0.2s;
}
.fci.nd { cursor: default; }
.fci svg { width: 12px; height: 12px; flex-shrink: 0; margin-top: 2px; color: var(--gold); }
.fci:not(.nd):hover { color: var(--goldL); }

.foot-bar {
  border-top: 1px solid var(--line);
  position: relative;
  z-index: 1;
}
.foot-bar-row {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 16px 0;
}
.foot-bar-row p { color: var(--dim); font-size: 12px; }
.fbar-links { display: flex; gap: 20px; }
.fbar-links a { color: var(--dim); font-size: 12px; text-decoration: none; transition: color 0.2s; }
.fbar-links a:hover { color: var(--goldL); }

/* ══════════════════════════════════════════
   RESPONSIVE
══════════════════════════════════════════ */
@media (max-width: 1024px) {
  .foot-body { grid-template-columns: 1fr 1fr; gap: 36px; }
}

@media (max-width: 768px) {
  .strip-left { display: none; }
  .strip-right { margin: 0 auto; }

  /* Mobile nav overlay */
  .nav-links {
    display: none;
    position: fixed;
    top: calc(42px + 70px);
    left: 0; right: 0; bottom: 0;
    flex-direction: column;
    align-items: stretch;
    background: rgba(6,9,17,0.99);
    backdrop-filter: blur(28px);
    -webkit-backdrop-filter: blur(28px);
    padding: 24px 20px;
    gap: 4px;
    z-index: 998;
    border-top: 1px solid var(--line);
    overflow-y: auto;
  }
  .nav-links.open { display: flex; }

  .nl {
    padding: 14px 18px;
    font-size: 16px;
    border-radius: 12px;
    text-align: left;
  }
  .nl-book {
    margin-left: 0 !important;
    margin-top: 12px;
    justify-content: center;
    border-radius: 12px;
    padding: 15px 20px;
    font-size: 15px;
  }
  .burger { display: flex; }

  .foot-body { grid-template-columns: 1fr; gap: 28px; padding-top: 44px; padding-bottom: 36px; }
  .fb-brand p { max-width: 100%; }
  .foot-bar-row { flex-direction: column; gap: 10px; text-align: center; }
}

@media (max-width: 480px) {
  .sl.nd { display: none; }
  .sdiv  { display: none; }
}
</style>
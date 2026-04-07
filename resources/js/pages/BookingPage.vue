<template>
  <div class="pg">

    <div class="page-hero">
      <div class="ph-bg"><div class="ph-orb"></div><div class="ph-grid"></div></div>
      <div class="container ph-body">
        <div class="breadcrumb" v-obs>
          <router-link to="/">Home</router-link>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>
          <span>Book Pickup</span>
        </div>
        <h1 v-obs>Schedule a <em class="accent">Free Pickup</em></h1>
        <p v-obs>Fill the form below — we collect, clean, and deliver right to your door.</p>
      </div>
    </div>

    <section class="section">
      <div class="container bk-layout">

        <!-- FORM -->
        <div class="bk-form-wrap" v-obs>

          <div v-if="done" class="success">
            <div class="suc-ico">✅</div>
            <h2>Booking Confirmed!</h2>
            <p>Thank you, <strong>{{ last.name }}</strong>! We'll contact you shortly to confirm your pickup on <strong>{{ last.date }}</strong>.</p>
            <div class="suc-summary">
              <div class="ss-row"><span>Services</span><strong>{{ last.services.join(', ') }}</strong></div>
              <div class="ss-row"><span>Time Slot</span><strong>{{ last.time }}</strong></div>
              <div class="ss-row"><span>Express</span><strong>{{ last.express ? 'Yes (+50%)' : 'No' }}</strong></div>
            </div>
            <button class="btn-gold" @click="reset">Book Another Pickup</button>
          </div>

          <form v-else @submit.prevent="submit" novalidate>
            <h2 class="form-title">Your Details</h2>

            <div class="form-row">
              <div class="fg" :class="{ err: errors.name }">
                <label>Full Name *</label>
                <input v-model="f.name" type="text" placeholder="Your full name" @blur="val('name')" />
                <span class="em" v-if="errors.name">{{ errors.name }}</span>
              </div>
              <div class="fg" :class="{ err: errors.phone }">
                <label>Phone Number *</label>
                <input v-model="f.phone" type="tel" placeholder="+91 XXXXX XXXXX" @blur="val('phone')" />
                <span class="em" v-if="errors.phone">{{ errors.phone }}</span>
              </div>
            </div>

            <div class="fg">
              <label>Email Address</label>
              <input v-model="f.email" type="email" placeholder="your@email.com" />
            </div>

            <div class="fg" :class="{ err: errors.services }">
              <label>Services Required *</label>
              <div class="svc-pick">
                <label
                  v-for="s in svcOpts"
                  :key="s.value"
                  class="svc-tile"
                  :class="{ sel: f.services.includes(s.value) }"
                >
                  <input type="checkbox" :value="s.value" v-model="f.services" @change="val('services')" />
                  <span class="tile-ico">{{ s.icon }}</span>
                  <span class="tile-label">{{ s.label }}</span>
                  <span class="tile-check" v-if="f.services.includes(s.value)">✓</span>
                </label>
              </div>
              <span class="em" v-if="errors.services">{{ errors.services }}</span>
            </div>

            <div class="form-row">
              <div class="fg" :class="{ err: errors.date }">
                <label>Pickup Date *</label>
                <input v-model="f.date" type="date" :min="minDate" @blur="val('date')" />
                <span class="em" v-if="errors.date">{{ errors.date }}</span>
              </div>
              <div class="fg" :class="{ err: errors.time }">
                <label>Time Slot *</label>
                <select v-model="f.time" @blur="val('time')">
                  <option value="" disabled>Choose a time</option>
                  <option v-for="slot in slots" :key="slot" :value="slot">{{ slot }}</option>
                </select>
                <span class="em" v-if="errors.time">{{ errors.time }}</span>
              </div>
            </div>

            <div class="fg" :class="{ err: errors.address }">
              <label>Pickup Address *</label>
              <textarea v-model="f.address" rows="3" placeholder="House No., Street, Area, Ludhiana..." @blur="val('address')"></textarea>
              <span class="em" v-if="errors.address">{{ errors.address }}</span>
            </div>

            <div class="express-row">
              <div class="ex-info">
                <span class="ex-ico">⚡</span>
                <div>
                  <strong>Express Service (24-Hour)</strong>
                  <small>Adds 50% to the total price. Ready by next day.</small>
                </div>
              </div>
              <button type="button" class="toggle" :class="{ on: f.express }" @click="f.express=!f.express" role="switch" :aria-checked="f.express">
                <span class="tg-thumb"></span>
              </button>
            </div>

            <div class="fg">
              <label>Special Instructions</label>
              <textarea v-model="f.notes" rows="2" placeholder="Stains to treat, fragile items, special care notes..."></textarea>
            </div>

            <p v-if="submitErr" class="sub-err">{{ submitErr }}</p>

            <button type="submit" class="btn-gold submit-btn" :disabled="loading">
              <span v-if="loading" class="ldots"><span></span><span></span><span></span></span>
              <span v-else>Confirm Pickup Booking</span>
              <svg v-if="!loading" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </button>
          </form>
        </div>

        <!-- SIDEBAR -->
        <div class="bk-sidebar" v-obs>
          <div class="sb-card">
            <h3>Why Book With Us?</h3>
            <div class="sb-feats">
              <div class="sbf" v-for="f in sideFeats" :key="f.title">
                <span class="sbf-ico">{{ f.icon }}</span>
                <div>
                  <strong>{{ f.title }}</strong>
                  <p>{{ f.desc }}</p>
                </div>
              </div>
            </div>
          </div>

          <div class="sb-card">
            <h3>Need Help?</h3>
            <p>Call us directly and we'll help you schedule your pickup.</p>
            <a href="tel:+918534837704" class="call-link">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 8.81 19.79 19.79 0 01.02 2.18 2 2 0 012 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.9z"/></svg>
              +91 85348 37704
            </a>
          </div>

          <div class="sb-card">
            <h3>Quick Price Guide</h3>
            <div class="price-list">
              <div class="pl-row" v-for="p in quickPrices" :key="p.name">
                <span>{{ p.name }}</span>
                <strong>₹{{ p.price }}</strong>
              </div>
            </div>
            <router-link to="/services" class="view-all">View full pricing →</router-link>
          </div>
        </div>

      </div>
    </section>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import axios from 'axios'

const vObs = {
  mounted(el) {
    const d = el.style.getPropertyValue('--d') || '0s'
    el.style.cssText += `opacity:0;transform:translateY(26px);transition:opacity .65s ease ${d},transform .65s ease ${d};`
    const io = new IntersectionObserver(([e]) => {
      if (e.isIntersecting) { el.style.opacity='1';el.style.transform='translateY(0)';io.disconnect() }
    }, { threshold: 0.05 })
    io.observe(el)
  }
}

const done = ref(false)
const loading = ref(false)
const submitErr = ref('')
const last = ref({})
const errors = ref({})

const f = ref({ name:'',phone:'',email:'',address:'',services:[],date:'',time:'',express:false,notes:'' })

const minDate = computed(() => {
  const d = new Date(); d.setDate(d.getDate()+1)
  return d.toISOString().split('T')[0]
})

function val(field) {
  errors.value[field] = ''
  if (field==='name' && !f.value.name.trim()) errors.value.name='Please enter your full name.'
  if (field==='phone') {
    if (!f.value.phone.trim()) errors.value.phone='Phone number is required.'
    else if (!/^\+?[\d\s-]{10,}$/.test(f.value.phone)) errors.value.phone='Enter a valid phone number.'
  }
  if (field==='services' && f.value.services.length===0) errors.value.services='Please select at least one service.'
  if (field==='date' && !f.value.date) errors.value.date='Please select a pickup date.'
  if (field==='time' && !f.value.time) errors.value.time='Please select a time slot.'
  if (field==='address' && !f.value.address.trim()) errors.value.address='Pickup address is required.'
}

function valAll() {
  ['name','phone','services','date','time','address'].forEach(val)
  return Object.values(errors.value).every(e=>!e)
}

async function submit() {
  if (!valAll()) return
  loading.value = true
  submitErr.value = ''
  try {
    await axios.post('/api/v1/bookings', f.value)
    last.value = {
      name: f.value.name,
      date: f.value.date,
      time: f.value.time,
      express: f.value.express,
      services: f.value.services.map(s => svcOpts.find(o=>o.value===s)?.label||s)
    }
    done.value = true
  } catch {
    submitErr.value = 'Something went wrong. Please try again or call us directly.'
  } finally {
    loading.value = false
  }
}

function reset() {
  f.value = { name:'',phone:'',email:'',address:'',services:[],date:'',time:'',express:false,notes:'' }
  errors.value = {}
  done.value = false
}

const svcOpts = [
  {value:'washing',label:'Washing',icon:'👕'},
  {value:'dry_cleaning',label:'Dry Clean',icon:'🥼'},
  {value:'ironing',label:'Ironing',icon:'🧺'},
  {value:'blankets',label:'Blankets',icon:'🛏️'},
  {value:'wedding',label:'Wedding',icon:'👰'},
]

const slots = [
  '8:00 AM – 10:00 AM','10:00 AM – 12:00 PM','12:00 PM – 2:00 PM',
  '2:00 PM – 4:00 PM','4:00 PM – 6:00 PM','6:00 PM – 8:00 PM',
]

const sideFeats = [
  {icon:'🚗',title:'Free Home Pickup',desc:'We come to you — no extra charge.'},
  {icon:'📦',title:'Safe Delivery Back',desc:'Fresh, packaged, and on time.'},
  {icon:'💳',title:'Pay After Delivery',desc:'Pay only when fully satisfied.'},
  {icon:'🔒',title:'Satisfaction Guarantee',desc:"Free redo if you're not happy."},
]

const quickPrices = [
  {name:'Shirt / T-Shirt (Wash)',price:'30'},
  {name:'Suit Dry Cleaning',price:'200'},
  {name:'Ironing (per piece)',price:'20'},
  {name:'Blanket (Single)',price:'150'},
  {name:'Lehenga (Bridal)',price:'800'},
]
</script>

<style scoped>
:root{--void:#060911;--abyss:#0B1018;--slate:#111827;--panel:#1A2333;--rim:rgba(255,255,255,0.07);--rim2:rgba(232,160,32,0.18);--gold:#E8A020;--gold-lt:#F5C842;--gold-dim:#7A4A00;--gold-glow:rgba(232,160,32,0.14);--teal:#0EA5A0;--teal-lt:#2DD4BF;--cream:#F2EDE4;--fog:rgba(242,237,228,0.50);--mist:rgba(242,237,228,0.28);}
*{box-sizing:border-box;margin:0;padding:0;}
.pg{background:var(--void);color:var(--cream);font-family:'DM Sans',system-ui,sans-serif;}
.container{max-width:1240px;margin:0 auto;padding:0 28px;}
.section{padding:80px 0;}
.accent{color:var(--gold);font-style:normal;}

.page-hero{background:var(--abyss);position:relative;overflow:hidden;padding:80px 0 56px;border-bottom:1px solid var(--rim);}
.ph-bg{position:absolute;inset:0;}
.ph-orb{position:absolute;width:360px;height:360px;border-radius:50%;background:radial-gradient(circle,rgba(232,160,32,.1) 0%,transparent 65%);top:-90px;right:-90px;}
.ph-grid{position:absolute;inset:0;background-image:linear-gradient(rgba(255,255,255,.016) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.016) 1px,transparent 1px);background-size:60px 60px;}
.ph-body{position:relative;z-index:1;max-width:640px;}
.breadcrumb{display:flex;align-items:center;gap:6px;font-size:12.5px;color:var(--fog);margin-bottom:20px;}
.breadcrumb a{color:var(--gold);text-decoration:none;}
.breadcrumb svg{width:13px;height:13px;}
.ph-body h1{font-family:'Cormorant Garamond','Playfair Display',serif;font-size:clamp(2.4rem,5vw,3.8rem);font-weight:900;margin-bottom:13px;}
.ph-body p{color:var(--fog);font-size:16px;line-height:1.7;}

/* LAYOUT */
.bk-layout{display:grid;grid-template-columns:1fr 360px;gap:36px;align-items:start;}
.bk-form-wrap{background:var(--slate);border:1px solid var(--rim);border-radius:22px;padding:42px;}

/* SUCCESS */
.success{text-align:center;padding:36px 0;}
.suc-ico{font-size:52px;display:block;margin-bottom:20px;animation:popin .5s ease both;}
@keyframes popin{from{transform:scale(.5);opacity:0}to{transform:scale(1);opacity:1}}
.success h2{font-family:'Cormorant Garamond','Playfair Display',serif;font-size:1.9rem;margin-bottom:11px;}
.success p{color:var(--fog);margin-bottom:22px;line-height:1.7;}
.suc-summary{background:var(--panel);border:1px solid var(--rim);border-radius:13px;padding:18px;margin-bottom:26px;text-align:left;}
.ss-row{display:flex;justify-content:space-between;padding:7px 0;border-bottom:1px solid var(--rim);font-size:13.5px;}
.ss-row:last-child{border-bottom:none;}
.ss-row span{color:var(--fog);}
.ss-row strong{color:var(--gold);}

/* FORM */
.form-title{font-family:'Cormorant Garamond','Playfair Display',serif;font-size:1.5rem;font-weight:800;margin-bottom:26px;}
form{display:flex;flex-direction:column;gap:18px;}
.form-row{display:grid;grid-template-columns:1fr 1fr;gap:14px;}
.fg{display:flex;flex-direction:column;gap:7px;}
.fg label{font-size:12.5px;font-weight:500;color:var(--fog);}
.fg input,.fg select,.fg textarea{background:var(--panel);border:1px solid var(--rim);color:var(--cream);font-family:'DM Sans',system-ui,sans-serif;font-size:13.5px;padding:12px 15px;border-radius:11px;outline:none;transition:border-color .2s,box-shadow .2s;}
.fg input:focus,.fg select:focus,.fg textarea:focus{border-color:var(--gold);box-shadow:0 0 0 3px rgba(232,160,32,.12);}
.fg input::placeholder,.fg textarea::placeholder{color:var(--mist);}
.fg select option{background:var(--slate);}
.fg textarea{resize:vertical;min-height:82px;}
.fg.err input,.fg.err select,.fg.err textarea{border-color:#F87171;}
.em{font-size:11.5px;color:#F87171;}

/* SERVICE TILES */
.svc-pick{display:grid;grid-template-columns:repeat(5,1fr);gap:9px;}
.svc-tile{display:flex;flex-direction:column;align-items:center;gap:6px;padding:13px 7px;border:1px solid var(--rim);border-radius:13px;cursor:pointer;transition:all .2s;text-align:center;position:relative;}
.svc-tile input{display:none;}
.svc-tile:hover{border-color:var(--rim2);}
.svc-tile.sel{border-color:var(--gold);background:rgba(232,160,32,.09);}
.tile-ico{font-size:22px;transition:transform .2s;}
.svc-tile.sel .tile-ico{transform:scale(1.1);}
.tile-label{font-size:10.5px;color:var(--fog);font-weight:500;}
.svc-tile.sel .tile-label{color:var(--gold-lt);}
.tile-check{position:absolute;top:5px;right:8px;font-size:10px;color:var(--gold);font-weight:700;}

/* EXPRESS */
.express-row{display:flex;align-items:center;justify-content:space-between;gap:14px;background:var(--panel);border:1px solid var(--rim);border-radius:13px;padding:15px 18px;}
.ex-info{display:flex;align-items:center;gap:13px;flex:1;}
.ex-ico{font-size:20px;}
.ex-info strong{display:block;font-size:13.5px;font-weight:600;margin-bottom:2px;}
.ex-info small{color:var(--fog);font-size:11.5px;}
.toggle{width:48px;height:26px;border-radius:13px;background:var(--abyss);border:1px solid var(--rim);cursor:pointer;position:relative;transition:background .2s,border-color .2s;flex-shrink:0;}
.toggle.on{background:var(--gold);border-color:var(--gold);}
.tg-thumb{position:absolute;top:3px;left:3px;width:18px;height:18px;border-radius:50%;background:#fff;box-shadow:0 1px 3px rgba(0,0,0,.3);transition:transform .2s;}
.toggle.on .tg-thumb{transform:translateX(22px);}

.sub-err{color:#F87171;font-size:12.5px;text-align:center;}
.btn-gold{display:inline-flex;align-items:center;justify-content:center;gap:10px;background:linear-gradient(135deg,var(--gold),var(--gold-dim));color:#fff;font-weight:700;font-size:15px;padding:15px 26px;border-radius:50px;border:none;cursor:pointer;text-decoration:none;box-shadow:0 5px 20px rgba(232,160,32,.38);transition:all .2s;width:100%;}
.btn-gold:hover:not(:disabled){transform:translateY(-2px);box-shadow:0 10px 28px rgba(232,160,32,.52);}
.btn-gold:disabled{opacity:.45;cursor:not-allowed;}
.btn-gold svg{width:17px;height:17px;}
.submit-btn{margin-top:4px;font-size:15.5px;padding:16px 26px;}
.ldots{display:flex;gap:5px;align-items:center;}
.ldots span{width:6px;height:6px;border-radius:50%;background:#fff;animation:ldot 1.2s ease infinite;}
.ldots span:nth-child(2){animation-delay:.2s;}
.ldots span:nth-child(3){animation-delay:.4s;}
@keyframes ldot{0%,100%{opacity:.25;transform:scale(.8)}50%{opacity:1;transform:scale(1)}}

/* SIDEBAR */
.bk-sidebar{display:flex;flex-direction:column;gap:18px;}
.sb-card{background:var(--slate);border:1px solid var(--rim);border-radius:18px;padding:26px;}
.sb-card h3{font-family:'Cormorant Garamond','Playfair Display',serif;font-size:1.1rem;font-weight:700;margin-bottom:18px;}
.sb-feats{display:flex;flex-direction:column;gap:14px;}
.sbf{display:flex;gap:12px;align-items:flex-start;}
.sbf-ico{font-size:18px;flex-shrink:0;width:36px;height:36px;background:rgba(232,160,32,.08);border:1px solid rgba(232,160,32,.14);border-radius:9px;display:flex;align-items:center;justify-content:center;}
.sbf strong{display:block;font-size:13px;font-weight:600;margin-bottom:2px;}
.sbf p{font-size:11.5px;color:var(--fog);line-height:1.5;}
.sb-card p{color:var(--fog);font-size:13.5px;line-height:1.6;margin-bottom:15px;}
.call-link{display:flex;align-items:center;gap:9px;background:rgba(232,160,32,.1);border:1px solid rgba(232,160,32,.22);color:var(--gold-lt);font-weight:600;font-size:14.5px;padding:12px 16px;border-radius:11px;text-decoration:none;transition:all .2s;}
.call-link:hover{background:rgba(232,160,32,.18);border-color:var(--gold);}
.call-link svg{width:15px;height:15px;}
.price-list{display:flex;flex-direction:column;margin-bottom:14px;}
.pl-row{display:flex;justify-content:space-between;align-items:center;padding:9px 0;border-bottom:1px solid var(--rim);font-size:12.5px;}
.pl-row:last-child{border-bottom:none;}
.pl-row span{color:var(--fog);}
.pl-row strong{color:var(--gold);}
.view-all{font-size:12.5px;color:var(--gold);text-decoration:none;font-weight:600;}
.view-all:hover{text-decoration:underline;}

@media(max-width:1024px){
  .bk-layout{grid-template-columns:1fr;}
  .bk-sidebar{display:grid;grid-template-columns:1fr 1fr;}
  .bk-sidebar .sb-card:last-child{grid-column:span 2;}
}
@media(max-width:768px){
  .section{padding:52px 0;}
  .svc-pick{grid-template-columns:repeat(3,1fr);}
  .form-row{grid-template-columns:1fr;}
  .bk-form-wrap{padding:26px 18px;}
  .bk-sidebar{grid-template-columns:1fr;}
  .bk-sidebar .sb-card:last-child{grid-column:span 1;}
}
@media(max-width:480px){.svc-pick{grid-template-columns:repeat(2,1fr);}}
</style>

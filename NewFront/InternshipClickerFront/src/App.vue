<template>
  <div v-if="appTexts">
    <header>
      <div class="top-row">
        <!-- DARK MODE BUTTON -->
        <button class="BTNSettings" id="DMSwitch" @click="changeTheme">
          <span v-if="darkMode">
            <svg fill="White" height="40px" width="40px" viewBox="0 0 24 24">
              <path
                d="M13 6V3M18.5 12V7M14.5 4.5H11.5M21 9.5H16M15.5548 16.8151C16.7829 16.8151 17.9493 16.5506 19 16.0754C17.6867 18.9794 14.7642 21 11.3698 21C6.74731 21 3 17.2527 3 12.6302C3 9.23576 5.02061 6.31331 7.92462 5C7.44944 6.05072 7.18492 7.21708 7.18492 8.44523C7.18492 13.0678 10.9322 16.8151 15.5548 16.8151Z"
                stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </span>
          <span v-else>
            <svg viewBox="0 0 24 24" fill="#303234" height="40px" width="40px">
              <path
                d="M12 3V4M12 20V21M4 12H3M6.31412 6.31412L5.5 5.5M17.6859 6.31412L18.5 5.5M6.31412 17.69L5.5 18.5001M17.6859 17.69L18.5 18.5001M21 12H20M16 12C16 14.2091 14.2091 16 12 16C9.79086 16 8 14.2091 8 12C8 9.79086 9.79086 8 12 8C14.2091 8 16 9.79086 16 12Z"
                stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </span>
        </button>

        <!-- SETTINGS BUTTON -->
        <button class="BTNSettings" @click="showSettings">
          <svg
            :fill="darkMode ? 'White' : '#303234'"
            :stroke="darkMode ? 'Black' : 'White'"
            stroke-width="1.8"
            stroke-linecap="round"
            stroke-linejoin="round"
            height="40"
            width="40"
            viewBox="0 0 24 24"
          >
            <!-- outer gear -->
            <path d="M19.44 12.98c.04-.32.06-.65.06-.98s-.02-.66-.06-.98l1.7-1.32a.5.5 0 0 0 .12-.63l-1.61-2.79a.5.5 0 0 0-.6-.22l-2 .8c-.5-.38-1.03-.7-1.62-.94l-.3-2.12A.5.5 0 0 0 14.29 3h-3.18a.5.5 0 0 0-.49.4l-.3 2.12c-.59.24-1.12.56-1.62.94l-2-.8a.5.5 0 0 0-.6.22L4.49 8.07a.5.5 0 0 0 .12.63l1.7 1.32c-.04.32-.06.65-.06.98s.02.66.06.98l-1.7 1.32a.5.5 0 0 0-.12.63l1.61 2.79c.14.25.44.35.7.26l2-.8c.5.38 1.03.7 1.62.94l.3 2.12c.05.24.25.4.49.4h3.18c.24 0 .45-.16.49-.4l.3-2.12c.59-.24 1.12-.56 1.62-.94l2 .8c.26.1.56 0 .7-.26l1.61-2.79a.5.5 0 0 0-.12-.63l-1.7-1.32z"/>

            <!-- center circle -->
            <circle cx="12" cy="12" r="3.5"/>
          </svg>
        </button>



      </div>

      <h1 class="text">{{ appTexts.title[currentLanguage] }}</h1>
    </header>

    <h3 class="text">
      {{ appTexts.ratePerClick[currentLanguage] }}: {{ clickPower }} | 
      {{ appTexts.ratePassive[currentLanguage] }}: {{ passiveCv }}
    </h3>

    <div id="counter">
      <h2 id="count">{{ Cv }}</h2>
      <h2 class="text">{{ appTexts.pendingApplications[currentLanguage] }}</h2>
    </div>

    <button id="mainButton" @click="increment">
      <img style="max-width: 3vw" src="./assets/externalFiles/linkedin-svgrepo-com.svg">
      <span>{{ appTexts.mainButton[currentLanguage] }}</span>
    </button>

    <button class="switchButton" @click="showUpgrades">
      {{ upgradesShown ? appTexts.hideUpgrades[currentLanguage] : appTexts.showUpgrades[currentLanguage] }}
    </button>

    <div id="upgradeList" v-show="upgradesShown">
      <div class="upgrade" v-for="(up, index) in upgrades" :key="index">
        <div v-if="up.cost !== -1">
          <h3 class="text">{{ up["title_" + currentLanguage] }}</h3>
          <p class="text">{{ up["subtitle_" + currentLanguage] }}</p>
          <p class="text">{{ up["effect_description_" + currentLanguage] }}</p>

          <p class="text" v-if="AMOUNT_UNLOCK - up.amountBought > 0">
            {{ appTexts.amountNext[currentLanguage] }} : {{ AMOUNT_UNLOCK - up.amountBought }}
          </p>

          <button class="clickButton"
            @mouseenter="(event) => checkCost(index,event)"
            @click="processUpgrade(index)">
            {{ appTexts.upgrade[currentLanguage] }} 
            ({{ appTexts.rejectedOn[currentLanguage] }} {{ up.cost }} {{ appTexts.applications[currentLanguage] }})
          </button>
        </div>
      </div>
    </div>
    <div v-if="!upgradesShown">
      <p class="text">{{ appTexts.noUShown[currentLanguage] }}</p>
    </div>


    <!-- SETTINGS POPUP -->
    <div v-show="settingsShown" class="popup-light popup" id="popup">
      <div class="BTNClose">
        <button @click="showSettings">
          <img src="./assets/externalFiles/close.svg" alt="leave">
        </button>
      </div>

      <div v-if="leaderboard != null">
        <h3 class="text">{{ appTexts.leaderboardTopFive[currentLanguage] }}</h3>
        <table><tbody>
          <tr v-for="(lb,index) in leaderboard" :key="lb.user_name">
            <td :style="{ backgroundColor: getRankColor(index) }" class="text">{{ lb.user_name }}</td>
            <td class="text">{{ lb.score }}</td>
          </tr>
        </tbody></table>

        <label for="name" class="text">{{ appTexts.username[currentLanguage] }}</label>
        <input id="name" type="text" v-model="username">
        <button class="clickButton" @click="submitScore">{{ appTexts.submitScore[currentLanguage] }}</button>
      </div>

      <div>
        <h3 class="text">{{ appTexts.language[currentLanguage] }}</h3>
        <label for="language" class="text">{{ appTexts.pickLanguage[currentLanguage] }}</label>

        <select class="clickButton" v-model="currentLanguage" id="language">
          <option value="fr">Français</option>
          <option value="en">English</option>
          <option value="emojis">✅</option>
        </select>
      </div>
    </div>

    <footer class="footer-light">
      <p class="text">A. Baco</p>
      <p class="text">alistair.baco@ensiie.eu</p>
    </footer>
  </div>
</template>

<script>
const API_URL = "http://localhost:8000/api.php";

export default {
  name: "App",

  data() {
    return {
      title: "Very realistic simulation of the job market",
      Cv: 0,
      AMOUNT_UNLOCK: 10,
      passiveCv: 0,
      passiveStarted: false,
      clickPower: 1,
      maxUnlockedId: 0,
      upgradesNb: null,
      settingsShown: false,
      upgradesShown: false,
      upgrades: null,
      keysPressed: {},
      codeCounter: 0,
      leaderboard: null,
      appTexts: null,
      currentLanguage: "en",
      darkMode: true,
      username: "Anonymous User",
    };
  },

  async mounted() {
    window.addEventListener("keydown", this.handleKeydown);
    window.addEventListener("keyup", this.handleKeyup);

    await fetch(API_URL + "?table=Upgrade")
      .then(r => r.json())
      .then(data => {
        this.upgrades = data;
        this.upgradesNb = data.length;
      });

    this.loadLB();

    fetch("/src/assets/externalFiles/texts.json")
      .then(r => r.json())
      .then(data => (this.appTexts = data));
  },

  beforeUnmount() {
    window.removeEventListener("keydown", this.handleKeydown);
    window.removeEventListener("keyup", this.handleKeyup);
  },

  methods: {
    sleep(ms){ return new Promise(res => setTimeout(res, ms)); },

    increment() { this.Cv += this.clickPower; },
    showUpgrades() { this.upgradesShown = !this.upgradesShown; },
    handleKeyup() { this.keysPressed = {}; },
    handleKeydown(e) {
      this.keysPressed[e.key] = true;
      this.checkCheat(e.key);
    },

    checkCheat(newKey) {
      const code = ["ArrowUp","ArrowUp","ArrowDown","ArrowDown","ArrowLeft","ArrowRight","ArrowLeft","ArrowRight","b","a","Enter"];
      if (newKey === code[this.codeCounter]) {
        if (this.codeCounter + 1 === code.length) {
          this.giveMax();
          this.codeCounter = 0;
          new Audio("/src/assets/externalFiles/crazyFun.mp3").play();
        } else this.codeCounter++;
      } else this.codeCounter = 0;
    },

    changeClickPower(n) { this.clickPower += n; },
    changeScore(n) { this.Cv += n; },
    showSettings() { this.settingsShown = !this.settingsShown; },
    giveMax() { this.Cv += 1e60; },

    initUpgrade(id) { this.upgrades[id].cost = this.upgrades[id].baseCost; },

    unlockNew() {
      if (this.maxUnlockedId >= this.upgradesNb - 1) return;
      this.maxUnlockedId++;
      this.initUpgrade(this.maxUnlockedId);
    },

    checkCost(id, event) {
      event.target.style.cursor = this.Cv >= this.upgrades[id].cost ? "inherit" : "no-drop";
    },

    updatePrice(id) {
      const up = this.upgrades[id];
      up.cost += up.baseCost * up.amountBought;
    },

    async processUpgrade(id) {
      const up = this.upgrades[id];
      if (this.Cv >= up.cost) {
        const method = this[up.called_method];
        if (method) method(id);

        this.Cv -= up.cost;
        up.amountBought++;
        this.updatePrice(id);

        if (up.amountBought === this.AMOUNT_UNLOCK) this.unlockNew();
      }

      if (this.passiveCv && !this.passiveStarted) {
        this.applyPassive();
        this.passiveStarted = true;
      }
    },

    upgradeClickPower() { this.changeClickPower(1); },
    upgradeTenClickPower() { this.changeClickPower(10); },
    timesTwoClickPower() { this.changeClickPower(this.clickPower); },
    passiveUpTest() { this.passiveCv += 10; },

    async applyPassive() {
      while (true) {
        await this.sleep(1000);
        this.Cv += this.passiveCv;
      }
    },

    getRankColor(i) {
      if (i === 0) return "gold";
      if (i === 1) return "silver";
      if (i === 2) return "#cd7f32";
      return "";
    },

    async submitScore() {
      await fetch(API_URL, {
        method: "POST",
        body: JSON.stringify({
          table: "Leaderboard",
          user_name: this.username,
          score: this.Cv,
        }),
      });

      this.loadLB();
    },

    async loadLB() {
      await fetch(API_URL + "?table=Leaderboard")
        .then(r => r.json())
        .then(data => (this.leaderboard = data.slice(0, 5)));
    },

    changeTheme() {
      const bg = document.body;
      const text = bg.querySelectorAll(".text");
      const btn = bg.querySelectorAll(".clickButton,.switchButton");

      let [bgCol, fgCol] = this.darkMode ? ["#303234", "#dbdbdb"] : ["White", "Black"];

      bg.style.backgroundColor = bgCol;
      text.forEach(e => (e.style.color = fgCol));
      btn.forEach(e => {
        e.style.backgroundColor = fgCol;
        e.style.color = bgCol;
      });

      const popup = document.getElementById("popup");
      const popupText = popup.querySelectorAll(".text");

      popup.classList.toggle("popup-light", !this.darkMode);
      popup.classList.toggle("popup-dark", this.darkMode);

      popupText.forEach(e => (e.style.color = this.darkMode ? "White" : "Black"));

      const footer = document.querySelector("footer");
      footer.classList.toggle("footer-light", !this.darkMode);
      footer.classList.toggle("footer-dark", this.darkMode);

      this.darkMode = !this.darkMode;
    }
  },
};
</script>

<style>
@import "./style/style.css";
@import "./style/giganticButtonsStyle.css";
</style>

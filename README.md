# pro-pro-NCU —— 國立中央大學 (NCU) 課程管理與排課系統

一個基於 Laravel + Vite + SQLite 的 Web 應用程式，專為中央大學學生設計，提供課程搜尋、每週課表排課、畢業與修課學分統計儀表板、個人行事曆管理，並內建經典網頁小遊戲。

---

## 📖 專案背景與簡介
本專案最初為大二網頁程式設計課程的專題作品。為了解決舊有設計中存在的安全隱憂與代碼雜亂等問題，專案近期進行了**自主重構與安全防護升級**（詳見 [REFORM_PLAN.md](REFORM_PLAN.md)）。

重構重點包括：
* **資訊安全防禦**：密碼由明文改為安全 Bcrypt 雜湊加密。
* **權限與邊界防護**：利用 Laravel 中介軟體 (Middleware) 阻斷未登入用戶繞過網頁進入後台。
* **健壯性強化**：前後端表單資料驗證，杜絕非法空資料。
* **代碼規範化**：將原本混雜的手寫 SQL 語句徹底重構為標準優雅的 Laravel Eloquent ORM。

---

## 🌟 核心功能

### 1. 使用者驗證與個人化設定 (Auth & Profile)
* **註冊與登入**：使用學號與密碼註冊，密碼在寫入資料庫前經 `Hash::make()` 進行雜湊，並透過 `Hash::check()` 完成安全登入驗證。
* **路由中介軟體 (Middleware) 防護**：自訂 `sess` 中介軟體對後台所有頁面進行安全檢測，未登入者一律攔截並導回登入頁。
* **個人資料修改**：支持在設定頁面修改暱稱（預設「小松果」）及選擇更換個人頭像貼圖。

### 2. 修課學分儀表板 (Credits Dashboard)
* **學分圓餅圖與進度統計**：視覺化呈現目前學期或歷年修課學分分佈。
* **課程類別動態變更**：支持將課程分類為「必修」、「選修」、「通識」等，系統會動態即時重算學分，幫助學生追蹤修課進度。

### 3. 課程查詢與排課 (Course Search & Timetable)
* **多維度搜尋**：可指定開課單位（學院、系所）、課程名稱、教師名稱、課程代號以及「上課時段」進行篩選。
* **一鍵加選/退選**：搜尋結果中可一鍵點選「加入課表」，自動保存至個人課表。
* **每週功課表 (Weekly Timetable)**：採用 9x7 的直觀網頁課表，顯示每週一至週五各節次的課程名稱、教師及上課教室，支援從課表一鍵移除課程。

### 4. 個人行事曆 (Personal Calendar)
* **行程管理**：提供月曆/週曆/日曆視圖，方便使用者自訂行程事件，記錄重要考試、作業截止日等。
* **首頁今日行程**：登入首頁自動載入並列出今日待辦事項，讓日程一目了然。

### 5. 休閒小遊戲 (Mini-Games)
* 內建兩款以 Vanilla JS 寫成的經典網頁小遊戲，豐富學生的校園休閒生活：
  * **吃松果小遊戲 (Eat Squirrel)**：接住松果的鍵盤動作遊戲。
  * **俄羅斯方塊 (Tetris / Russia)**：經典下落式方塊拼圖。

---

## 🛠️ 技術棧與工具

* **後端架構**：PHP 8.2+ / Laravel 11
* **前端技術**：Vite 5 / Axios / Bootstrap 5 / Vanilla JS
* **資料庫**：SQLite (預設為 `database/database.sqlite`)
* **資料獲取子系統**：Node.js (位於 `datafetcher/`，調用 NCU 課表系統內部 API 以抓取最新課程)

---

## 📂 專案目錄結構

```bash
pro-pro-NCU/
├── app/
│   ├── Http/
│   │   ├── Controllers/    # 核心控制器 (WelcomeController, HomeController, CourseController, CalendarController)
│   │   └── Middleware/     # 自訂登入驗證中介軟體 (sess.php)
│   └── Models/             # Eloquent 資料庫模型 (User, Course, Event)
├── bootstrap/              # 註冊中介軟體與應用初始化設定
├── config/                 # 框架設定檔 (database, session 等)
├── database/               # 資料庫遷移檔及 SQLite 資料庫檔案
│   ├── database.sqlite     # SQLite 本地資料庫
│   └── migrations/         # 資料庫結構遷移檔
├── datafetcher/            # 獨立的 Node.js 爬蟲，負責抓取並更新 NCU 課程資訊
│   ├── data/               # 抓取的課程資料 JSON
│   └── src/                # 爬蟲核心代碼
├── public/                 # 靜態資源 (CSS, JS, images)
│   └── js/
│       └── data.json       # 供前端搜尋的 NCU 課程資料檔
├── resources/
│   └── views/              # Blade 模板頁面 (包含 layouts, home, 課表, 行事曆, 遊戲等)
├── routes/
│   └── web.php             # 路由定義 (套用 sess 中介軟體群組)
├── REFORM_PLAN.md          # 專案重構計畫與任務進度表
└── README.md               # 本專案說明文件
```

---

## 🚀 快速開始

### 1. 安裝環境需求
請確保您的開發主機已安裝以下環境：
* **PHP** >= 8.2
* **Composer**
* **Node.js** >= 18 (及 npm)

### 2. 安裝與設定步驟

1. **複製專案並安裝後端依賴**
   ```bash
   composer install
   ```

2. **複製環境設定檔**
   ```bash
   cp .env.example .env
   ```
   *請確認 `.env` 檔案中的 `DB_CONNECTION` 設定為 `sqlite`：*
   ```ini
   DB_CONNECTION=sqlite
   ```

3. **初始化資料庫**
   若尚未建立 SQLite 資料庫檔案，請手動建立：
   ```bash
   touch database/database.sqlite
   ```
   然後執行 Migration 建立所需的資料表：
   ```bash
   php artisan migrate
   ```

4. **安裝前端套件並編譯**
   ```bash
   npm install
   ```

5. **啟動本機開發伺服器**
   在終端機中，分別啟動 Laravel 後端與 Vite 前端編譯服務：
   ```bash
   # 啟動 Laravel 伺服器
   php artisan serve

   # 啟動 Vite 熱重載開發服務
   npm run dev
   ```
   打開瀏覽器訪問 `http://127.0.0.1:8000/welcome` 即可進入登入/註冊畫面。

---

## 📡 更新課程資料 (Optional)
本專案的課程搜尋功能依賴本地 `public/js/data.json` 提供課程資訊。如需抓取最新學期的課程資料，請使用 `datafetcher` 子系統：

1. 進入 `datafetcher` 資料夾：
   ```bash
   cd datafetcher
   ```
2. 安裝 Node.js 依賴並設定環境：
   ```bash
   npm install
   cp .env.example .env
   ```
3. 執行抓取腳本：
   ```bash
   npm run update
   ```
4. 抓取完成後，將產生的 `data/dynamic/all.json` 複製並覆蓋至專案的 `/public/js/data.json` 即可。

---

## 🛡️ 安全重構改善紀錄
專案的重構任務已全數完成，所有重構過程細節、代碼前後對照、測試過程已記錄在 [REFORM_PLAN.md](REFORM_PLAN.md)。主要成果包括：
1. 資料表 `users` 的 `password` 欄位改為無限制長度以支援雜湊。
2. 註冊登入採用安全的 Bcrypt 加密，徹底告別明文密碼時代。
3. 透過自訂中介軟體 `sess` 對需要驗證的路由進行安全攔截，防堵直連漏洞。
4. 表單欄位新增必填及長度驗證，前端同步顯示錯誤彈窗。
5. 控制器手寫原生 SQL 大清洗，全面統一為 Laravel 的 Eloquent ORM 鏈式查詢，極大增強程式碼可讀性與安全性。

---

## 📄 授權條款
本專案採用 [MIT License](LICENSE) 授權。

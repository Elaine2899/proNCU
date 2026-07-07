# NCU 課程管理系統 —— 重構與自我挑戰計畫書

## 📝 1. 前言與自主提升動機

這個專案是我在大二的網頁程式課程與同學撰寫的 `pro-pro-NCU` 課程管理與排課系統。當時雖然完成了基本的選課、排課與行事曆功能，但回頭審視當初寫的程式碼，發現不論是在**系統安全性**、**權限控制**，還是**代碼規範（Clean Code）**上，都有許多可以大幅精進與改進的空間。

為了提升自我的後端開發實力，並加強對現代 Web 應用程式安全防護（如密碼雜湊、路由中介軟體）的理解，我決定發起這個**自主重構計畫**。我將針對這個大二的舊專案進行全面的安全性改造與程式碼重構，並透過這份文件詳細記錄「改造前後」的差異，作為自己程式設計能力成長的紀錄。

---

## 🔍 2. 舊專案問題診斷與分析

以現在更成熟的開發視角來看，大二時期的程式碼主要存在以下 5 大問題與安全隱憂：

| 編號 | 診斷類別 | 大二時期的舊設計 | 潛在風險與缺點 | 預期改善方案 |
| :--- | :--- | :--- | :--- | :--- |
| **01** | **資訊安全** | 註冊時密碼直接以 **明文（Plaintext）** 寫入資料庫，登入時亦直接比對明文。 | 資料庫一旦外洩，使用者的原始密碼將直接曝光，極度危險。 | 引入安全的 `Hash::make()` (Bcrypt) 對密碼進行雜湊加密存儲。 |
| **02** | **權限控制** | 後台頁面（首頁、行事曆、課表）沒有綁定驗證中介軟體（Middleware）。 | 任何人只要在瀏覽器直接輸入網頁路由網址，即可繞過登入直接存取系統。 | 套用 Laravel 自訂的中介軟體，強制未登入的訪客重新導向至登入頁。 |
| **03** | **資料庫設計** | 密碼欄位限制長度為 `20` 字元（VARCHAR）。 | Bcrypt 加密後的字串固定為 60 字元，長度限制會導致寫入失敗或字串截斷。 | 修改 Migration 將密碼欄位長度放寬，以便能安全儲存加密雜湊。 |
| **04** | **資料驗證** | 登入與註冊控制器中，沒有對前端傳入的學號與密碼欄位進行後端驗證（Validation）。 | 使用者可提交空資料，可能造成資料庫髒資料寫入或程式執行出錯。 | 導入 Laravel 的 `$request->validate()` 驗證器，確保資料完整性。 |
| **05** | **代碼規範** | 控制器中混合使用原生 SQL 語句（`DB::select`）與 Eloquent ORM。 | 程式碼混亂、難以維護，且未充分發揮 Laravel Eloquent 簡潔優雅的特點。 | 全面將原生 SQL 重構為標準的 Eloquent ORM 鏈式調用，提升可讀性。 |

---

## 🛠️ 3. 重構執行計畫

本計畫預計分為三個階段進行自主改造：

### 階段一：底層安全性強化（Security Focus）
1. **調整資料表結構**：更新資料庫 Migration，解除密碼欄位 20 字元的長度限制。
2. **實作密碼雜湊化**：
   * 在註冊階段使用 `Hash::make` 對密碼進行加密。
   * 在登入階段使用 `Hash::check` 進行雜湊比對驗證。

### 階段二：系統邊界與權限防護（Authorization Focus）
1. **中介軟體註冊**：在 Laravel 的中介軟體配置中，註冊自訂的登入驗證中介軟體。
2. **路由群組防護**：將所有必須登入才能存取的路由包在 `auth` 中介軟體群組內。

### 階段三：健壯性與代碼美化（Clean Code & Robustness）
1. **欄位驗證機制**：加入後端表單欄位驗證，防止非法或空值輸入。
2. **ORM 語法重構**：將 Controller 內的手寫 SQL 查詢全部替換為符合 Eloquent 規範的查詢方式。

---

## 📊 4. 改造前後對照紀錄 (記錄中)

這部分將用來記錄我在重構過程中所做的具體程式碼修改，以展現自我的實作精進：

### 4.1 註冊與登入的密碼加密
* **大二寫法（明文儲存）**：
  ```php
  // WelcomeController.php
  $user->password = $password;
  ```
* **重構後寫法（雜湊加密）**：
  ```php
  // WelcomeController.php
  $user->password = Hash::make($password);
  ```

### 4.2 資料庫查詢方式
* **大二寫法（混合手寫 SQL）**：
  ```php
  // WelcomeController.php
  $query = "SELECT * FROM users WHERE studentID = ? AND password = ?";
  $result = DB::select($query, [$studentid, $password]);
  ```
* **重構後寫法（標準 Eloquent ORM）**：
  ```php
  // WelcomeController.php
  $user = User::where('studentID', $studentid)->first();
  if ($user && Hash::check($password, $user->password)) { ... }
  ```

---

## 📋 5. 重構任務與自主學習進度表

- [x] **任務 01**：修改資料庫欄位長度 (Migration) & 更新本地 SQLite 資料庫。
- [x] **任務 02**：實作註冊與登入密碼雜湊加密 (`Hash::make` & `Hash::check`)。
- [x] **任務 03**：註冊並套用 `sess` 登入驗證中介軟體。
- [x] **任務 04**：登入/註冊加上 `$request->validate` 表單驗證。
- [x] **任務 05**：將手寫 SQL 全部重構成 Eloquent ORM。
- [x] **任務 06**：完成重構後的本地功能整合測試。

---

## 🛠️ 6. 各任務重模細節與改善說明

### 6.1 任務 01：修改資料庫欄位長度 (Migration)
* **問題描述**：
  大二建庫時在 [2024_05_18_141703_create_users_table.php](file:///Users/yy/Documents/NCU/112/pro-pro-NCU/database/migrations/2024_05_18_141703_create_users_table.php) 將密碼長度上限寫死為 `20` 個字元。這會導致未來使用安全雜湊演算法時（加密後長度固定為 60 個字元）密碼存入失敗。
* **解決與修改方式**：
  1. 將 Migration 中的定義由 `$table->string('password', 20);` 調整為未限制的 `$table->string('password');`。
  2. 執行指令 `php artisan migrate:fresh` 重建底層的 SQLite 資料表結構。
* **改進與收穫**：
  資料庫欄位已具備足夠的容量，能夠完整儲存安全加密過後的密碼雜湊值（Hash），順利排成了密碼截斷的隱憂，並為後續的密碼安全升級（任務 02）做好了準備。

### 6.2 任務 02：實作註冊與登入密碼雜湊加密 (Hash::make & Hash::check)
* **問題描述**：
  大二時期，密碼直接以明文（Plaintext）寫入資料庫，且登入時也直接用明文進行比對。如果資料庫被不法分子取得，所有使用者的原始密碼將會直接曝光。
* **解決與修改方式**：
  1. 在 [WelcomeController.php](file:///Users/yy/Documents/NCU/112/pro-pro-NCU/app/Http/Controllers/WelcomeController.php) 頂部引入 `Illuminate\Support\Facades\Hash` 外觀（Facade）。
  2. 在 `register` 註冊方法中，將密碼修改為以 `Hash::make($password)` 加密後再行儲存。
  3. 在 `login` 登入方法中，移除原本 of SQL 明文比對。改為先使用 `User::where('studentID', $studentid)->first()` 取出使用者，再使用 `Hash::check($password, $user->password)` 比對傳入密碼是否符合雜湊值。
* **改進與收穫**：
  密碼現已使用業界標準的 Bcrypt 加密演算法安全存放，即使資料庫被盜，攻擊者也無法輕易解密還原使用者原始密碼，大大提升了應用程式的防禦力。

### 6.3 任務 03：註冊並套用 sess 登入驗證中介軟體
* **問題描述**：
  雖然專案內部寫好了自訂的登入驗證中介軟體 `sess.php`，但完全沒有將它載入或套用到任何路由上。這導致未登入的訪客可以繞過登入驗證，透過網址直連後台，引發安全隱憂且因 Session 為空而容易導致錯誤。
* **解決與修改方式**：
  1. 在 [bootstrap/app.php](file:///Users/yy/Documents/NCU/112/pro-pro-NCU/bootstrap/app.php) 的 `$middleware->alias` 設定中，將自訂的中介軟體 `\App\Http\Middleware\sess::class` 命名註冊為 `sess`。
  2. 在 [routes/web.php](file:///Users/yy/Documents/NCU/112/pro-pro-NCU/routes/web.php) 中，使用 `Route::middleware(['sess'])->group(...)` 路由群組包裝所有需要登入驗證的後台路由（例如課程搜尋、首頁、行事曆和課表等），唯獨將登入及註冊等進入點頁面排除在外。
* **改進與收穫**：
  成功實作了 Web 應用的權限與邊界防護。現在所有需要使用者資料的頁面都受到嚴格保護，訪客試圖強行進入時將會被攔截並安全重新導向回登入頁，大大提升了應用的健壯性。

### 6.4 任務 04：登入/註冊加上 $request->validate 表單驗證
* **問題描述**：
  大二時期，登入與註冊控制器中完全沒有對前端傳過來的資料做格式與長度檢查，只要學號或密碼為空也會直接往資料庫寫入或執行查詢，系統健壯性低，容易報錯。
* **解決與修改方式**：
  1. 在 [WelcomeController.php](file:///Users/yy/Documents/NCU/112/pro-pro-NCU/app/Http/Controllers/WelcomeController.php) 的 `register` 及 `login` 方法中加入 `$request->validate()`，要求學號（studentid）及密碼（password）皆為必填（required），且在註冊時要求最少字元數為 4。
  2. 在 [login.blade.php](file:///Users/yy/Documents/NCU/112/pro-pro-NCU/resources/views/login.blade.php) 檔案底部加入對錯誤訊息的偵測（檢查 `$errors->any()`），如有錯誤則自動彈出對應的錯誤提示（如 `alert($errors->first())`），維持原有的設計風格。
* **改進與收穫**：
  在後端加入了可靠的防護線，避免了無效空資料或不合規的資料被寫入資料庫，極大提升了系統的防錯性（Robustness）與使用者體驗。

### 6.5 任務 05：將手寫 SQL 全部重構成 Eloquent ORM
* **問題描述**：
  舊專案的控制器中混雜了許多手寫原生 SQL 查詢（例如使用 `DB::select` 查詢特定學號的課程或行事曆事件），這不符合 Laravel 框架的最佳實踐，降低了代碼的優雅度，且較難擴充與維護。
* **解決與修改方式**：
  1. 將 [CourseController.php](file:///Users/yy/Documents/NCU/112/pro-pro-NCU/app/Http/Controllers/CourseController.php) 中的 `DB::select` 替換為 `Course::where(...)` 模型查詢。例如：
     * 將 `getDashboardCourses` 改為 `Course::where('user_sid', $sid)->get()`。
     * 將 `getTableCourses` 改為 `Course::where('user_sid', $sid)->where('semester', $semester)->get()`。
  2. 將 [CalendarController.php](file:///Users/yy/Documents/NCU/112/pro-pro-NCU/app/Http/Controllers/CalendarController.php) 中舊的 `DB::table` 以及原生 SQL `DB::select` 替換為 Eloquent 模型查詢：
     * 將 `getEvents` 的 `DB::table('events')` 替換為 `Event::where('user_sid', $sid)->get()`。
     * 將 `getTodayEvents` 的原生 `SELECT * FROM events...` 替換為 `Event::where('user_sid', $sid)->where('end_time', $request->date)->get()`。
* **改進與收穫**：
  實作了全站 Eloquent ORM 的統一。重構後的代碼行數大幅縮減，邏輯清晰、易讀，完全符合 Laravel 的 Modern MVC 架構與編碼標準。

### 6.6 任務 06：完成重構後的本地功能整合測試
* **測試過程與驗證**：
  1. **未登入攔截測試**：直接嘗試在瀏覽器網址列存取 `/home` 或 `/course`，頁面均成功被 `sess` 中介軟體攔截，並重定向回 `/welcome` 登入頁面，同時正確顯示了「請先登入！」的提示警示。
  2. **表單空欄位驗證**：在登入與註冊時，刻意將學號或密碼留空點選送出，瀏覽器成功彈出「學號為必填欄位！」或「密碼為必填欄位！」的警示，證明表單後端驗證完美運作。
  3. **註冊與雜湊存儲**：成功註冊一名新學號測試用戶。利用 SQLite 檢視器檢查資料表結構，密碼欄位已被成功儲存為 Bcrypt 雜湊值（如 `$2y$12$...` ），完全隱藏了明文。
  4. **登入功能**：使用新註冊的帳密能正常登入系統，而輸入錯誤的學號或密碼時則會被拒絕並彈出錯誤提示，證明 `Hash::check` 運作十分精準。
  5. **選課、課表與行事曆功能**：登入後，進入課程搜尋、學分儀表板、我的課表以及行事曆，新增與刪除操作皆正常運作，證明 Eloquent ORM 重構完全成功且未破壞原先的 Ajax 互動功能。
* **重構總結**：
  本次自主重構計畫圓滿成功！我們不僅成功提升了本專案的系統邊界防護與資訊安全標準，還透過 Eloquent ORM 徹底理順了原本混亂的資料庫查詢邏輯。這是一次收穫極為豐碩的自我能力提升實踐。

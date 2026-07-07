# pro-pro-NCU 專案重構與改造計畫書

本文件紀錄了目前 `pro-pro-NCU` 專案所面臨的系統架構與安全性問題，並擬定對應的重構優化計畫，以便在後續的改造過程中能清晰地呈現「改造前後」的對比與修正成果。

---

## 📌 1. 專案現狀與問題診斷

經過系統審查，專案目前存在以下 5 大主要問題：

| 編號 | 診斷類別 | 具體問題描述 | 嚴重程度 | 潛在風險 |
| :--- | :--- | :--- | :--- | :--- |
| **01** | **資訊安全** | 註冊時密碼直接以 **明文（Plaintext）** 寫入資料庫，登入時亦直接比對明文。 | 🔴 嚴重 (Critical) | 資料庫外洩時，所有使用者的原始密碼直接曝光。 |
| **02** | **權限控制** | 登入中介軟體（Middleware）未套用到路由上，訪客可透過輸入網址直接存取後台頁面。 | 🔴 嚴重 (Critical) | 匿名使用者可隨意操作系統，且在 Session 為空時會造成系統報錯。 |
| **03** | **資料庫設計** | 密碼欄位長度限制為 `20` 字元，不足以儲存雜湊加密後的 60 字元字串。 | 🟡 中度 (Medium) | 當啟用 Bcrypt 加密時，寫入資料庫會因長度截斷而發生儲存失敗。 |
| **04** | **資料驗證** | 登入與註冊無後端表單欄位驗證（Validation），直接讀取前端輸入。 | 🟡 中度 (Medium) | 使用者可提交空資料或非法格式，造成程式出錯或髒資料寫入。 |
| **05** | **代碼規範** | 控制器中混合使用原生 SQL 語句（`DB::select`）與 Eloquent ORM。 | 🟢 輕度 (Low) | 降低程式碼可維護性，且手寫 SQL 語法較難維護且不符合 Laravel 慣例。 |

---

## 🛠️ 2. 改造計畫與步驟

我們將按照以下步驟逐步進行專案的優化重構：

### 階段一：安全性與資料庫改造
1. **修改 Migration**：將 `users` 表的 `password` 欄位長度變更為無限制（預設 255 字元）。
2. **密碼雜湊加密**：
   * 在註冊控制器中使用 `Hash::make()` 對密碼進行加密。
   * 在登入控制器中使用 `Hash::check()` 進行安全驗證。

### 階段二：路由與權限防護
1. **註冊中介軟體**：在 `bootstrap/app.php` 中將自訂的 `sess` 驗證中介軟體命名並註冊。
2. **套用 Middleware**：在 `routes/web.php` 中使用路由群組（Route Group）將所有後台頁面（`/home`、`/calendar`、`/course` 等）納入登入驗證保護。

### 階段三：程式碼健壯性與重構
1. **新增欄位驗證**：在登入與註冊控制器中，使用 `$request->validate()` 強制要求學號與密碼必填，並處理錯誤回傳。
2. **重構為 Eloquent ORM**：將所有的手寫 SQL 語句替換成簡潔安全的 Eloquent 方法。

---

## 📊 3. 改造前後對照表 (進行中)

在稍後的改造過程中，我們將在此紀錄具體的代碼變更對照：

### 3.1 密碼加密存儲
```diff
# 改造前 (WelcomeController.php)
- $user->password = $password;

# 改造後 (WelcomeController.php)
+ $user->password = bcrypt($password); // 或使用 Hash::make($password)
```

### 3.2 密碼比對驗證
```diff
# 改造前 (WelcomeController.php)
- $query = "SELECT * FROM users WHERE studentID = ? AND password = ?";
- $result = DB::select($query, [$studentid, $password]);

# 改造後 (WelcomeController.php)
+ $user = User::where('studentID', $studentid)->first();
+ if ($user && Hash::check($password, $user->password)) { ... }
```

### 3.3 路由權限保護
```diff
# 改造前 (routes/web.php)
- Route::get('/home', [HomeController::class, 'ShowHomePage'])->name('home');

# 改造後 (routes/web.php)
+ Route::middleware(['sess'])->group(function () {
+     Route::get('/home', [HomeController::class, 'ShowHomePage'])->name('home');
+ });
```

---

## 📋 4. 重構任務清單

- [ ] **任務 01**：修改資料庫欄位長度 (Migration) & 更新本地 SQLite 資料庫。
- [ ] **任務 02**：實作註冊與登入密碼雜湊加密 (`Hash::make` & `Hash::check`)。
- [ ] **任務 03**：註冊並套用 `sess` 登入驗證中介軟體。
- [ ] **任務 04**：登入/註冊加上 `$request->validate` 表單驗證。
- [ ] **任務 05**：將手寫 SQL 全部重構成 Eloquent ORM。
- [ ] **任務 06**：本地完整測試並 Push 到 GitHub。

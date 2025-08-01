![Nyxin Brute Force ](assets/images/logo.png)


### Nyxin PHP Password Cracker

**Tool Category:** `Ethical Cracker` – A tool for educational, research, and password security testing purposes.

## Introduction

**Nyxin** is a lightweight PHP-based tool designed to:

* Test the strength of passwords with permission.
* Be used in cybersecurity research.
* Help recover lost passwords.
* Perform legal penetration testing on systems you are authorized to test.

❗ **Important Notice:**
This tool must **not** be used for any malicious or unauthorized activity, such as attempting to access accounts without explicit permission from the owner of the target system.

---

## Disclaimer

> This tool is intended for **legal use only**.
> The developer or publisher is **not responsible** for any misuse or illegal activity involving this tool.

---

## 🔐 Features (Current Version)

* 🔢 **Flexible Character Set Selection**
  Supports choosing from **15+ predefined character groups**, covering the entire keyboard (e.g. uppercase letters, lowercase letters, digits, symbols, etc.).

* 🌍 **Supports Custom & Multilingual Character Sets**
  Define **custom sets** of characters or even use **non-Latin scripts** (Arabic, Cyrillic, Chinese, etc.) for generating passwords.

* 🎯 **Custom Start Point**
  Ability to set a **specific starting point** in the generation process — useful for resuming previous cracking sessions.

* 🧩 **Easily Editable & Extendable**
  Written in clean, modular PHP code — easy to **modify, extend, or integrate** with other tools or systems.

* 🗃️ **Wordlist & Algorithmic Modes**
  Can generate passwords using:

  * Internal brute-force algorithms
  * External or custom wordlists (dictionary attack)

* 🛜 **Works with Any PHP-Compatible Server**
  Supports integration with **any server or service** that PHP can communicate with, such as:

  * Web servers (`HTTP/HTTPS`)
  * Email servers (`SMTP`, `POP3`, `IMAP`)
  * FTP/SFTP/SSH connections
  * Proxy servers
  * Databases (`MySQL`, `PostgreSQL`, etc.)

* 🥷 **Advanced Use Cases**
  The tool can be adapted for:

  * Hash cracking (e.g., MD5, SHA1)
  * Executing scripted **XXS payloads** in test environments
  * Custom login/auth bypass logic via `Servers/` classes like `dojo.php`

* 🧪 **Training Ground for Integration**
  Includes a dedicated file (`Servers/dojo.php`) — a flexible sandbox designed for testing and developing custom server integrations or attack logic, using the `$password` / `$word` as instances of the `Nyxin` class.

* 🔒 **Offline & Secure**
  Runs completely offline. No external dependencies or network requirements — full control and privacy.

---


## How To Use (Quick Start) :

Nyxin Brute Force supports **both CLI and Web-based operation**

**CLI **

```bash
php src/index.php crack
```

**Web Interface**

```bash
http://localhost
```

or

```bash
http://localhost/src/?crack
```

Differences between CLI & web interface

| Feature            | CLI Mode                           | Web Interface                         |
| ------------------ | ---------------------------------- | ------------------------------------- |
| Configuration      | Manual edit of `configuration.php` | Can be modified via built-in web form |
| Stop Execution     | `Ctrl + C` or `Ctrl + Z`           | Requires special file (`stop.flag`)   |
| Intended Use Case  | Developers, power users            | Casual testing, visual UI             |
| Stability / Safety | More control, recommended          | Must be sandboxed / local only        |

> ⚠️ For web use, always run the tool in a **secure, isolated environment**. Never expose the tool to public access.

---

## ⚙️ Configuration Setup

All behavior is controlled by the `configuration.php` file located in  `src/Config` directory.

You can configure Nyxin Configuration.php file by either:

* 🖥️ **Using the Web Interface** (if running locally in a browser), or
* ✍️ **Manually editing** the PHP config file in a code/text editor. For more details (./config-help.txt).

For web usage, the tool provides a form interface to modify `configuration.php` through the browser (requires write permissions).

---

## 🛑 [IMPORTANT] How to Stop Execution ?!

**CLI Mode**

* To stop the tool safely, press:

  ```
  Ctrl + C
  ```

  or

  ```
  Ctrl + Z
  ```

  (depending on your terminal)

**Web Interface**

Since keyboard signals do **not** work in a browser, the tool uses a **flag file mechanism** to detect manual stop commands:

There is a file at:

arduino
Copy code
src/stop.flag
✍️ Inside the file, write the exact word:

vbnet
Copy code
STOP

The script checks for this file and its contents periodically. When it detects "STOP", it will terminate gracefully.

⚠️ Simply creating the file is not enough — the content must be exactly "STOP" (case-sensitive).

> 🧠 **Tip:** To automate clean shutdowns, consider adding a timeout or limit in `Core/Nyxin.php`.

---

## 🔌 Extensibility

The tool is designed with extensibility at its core. Developers can integrate additional PHP classes to support a wide range of protocols and targets, including but not limited to:

* `HTTP`, `FTP`, `SMTP`, `POP3`, `IMAP`
* `Telnet`, `SFTP`, `TFTP`, `SCP`, `SSH`, and more...

In addition to protocol-based integration, the project introduces a flexible and practical training ground through the `Servers/dojo.php` file — inspired by the Japanese word "dojo" (道場), meaning **a place of practice**.

Within this file, developers can experiment and test wordlists directly using:

* `$password` or `$word` as instances of the `Nyxin` class
* Support for wordlists-based iterations and dynamic injection

To ensure compatibility:

* All target classes (including `dojo.php` or any newly added file) **must reside inside the `Servers/` directory**
* Each class **must include a `handler()` function**, which serves as the main execution point

> 💡 **Any online server that supports PHP login/authentication can be targeted with proper integration. The `Servers/dojo.php` file provides a safe and extensible environment to simulate and test such integrations.**

For a full list of supported protocols and advanced usage instructions, see:
📄 [Advanced Usage & Integration Guide](./usage.txt)

---

## Success Rate

🟢 The tool can reach up to **99% success rate** in specific use cases, depending on:

* The complexity of the target password.
* The user’s ability to define patterns or predict formats.
* The quality of the provided wordlist.

---

## ⚠️ Important Warning

This tool performs **CPU-intensive and potentially infinite operations**, especially during brute-force attacks.

**Please read carefully before use:**

* Bruteforcing complex passwords may take **hours, days, or longer** depending on the charset and length.
* High CPU and memory usage is expected. **System instability is possible** during long runs.
* Targeting live servers can cause:
  - IP bans
  - Rate limiting
  - Server crashes
  - Legal consequences (if done without permission)
* Never run this script on a production server or public-facing website.
* Designed for **CLI (command-line interface)** only.

📄 For full details and critical safety notes, see: [WARNING.txt](./WARNING.txt)

> 💡 **Tip:** Smart use with analysis, small wordlists, and strategic targeting can drastically reduce cracking time.

---

## Requirements

* PHP 7.0 or higher
* Basic PHP knowledge (for customization or integration)

---

## 📄 License

This project is licensed under the **GNU Affero General Public License v3.0 (AGPL-3.0)**.

You are free to use, modify, and distribute this software under the terms of the AGPLv3.

📖 For full license text, see [LICENSE.txt](./LICENSE.txt) or visit:  
🔗 https://www.gnu.org/licenses/agpl-3.0.html

> 💡 Note: This software is intended strictly for **educational and legal use only**. Misuse is prohibited.

---
/**
 * Speed Clicker ゲームロジック
 * -  Start ボタン → ランダム待機 1〜3 秒
 * -  「クリック！」表示 → プレイヤーがクリックした反応時間を計測
 * -  5 回繰り返し、平均を算出 → /api/scores へ POST
 */

document.addEventListener("DOMContentLoaded", () => {
    const startBtn = document.getElementById("startBtn");
    const promptEl = document.getElementById("prompt");
    const resultsEl = document.getElementById("results");
    const averageEl = document.getElementById("average");

    let trials = []; // 各回の反応時間(ms)を格納
    let startTime = 0; // 「クリック！」が出た瞬間の時刻

    /**
     * UI をリセット
     */
    const resetGame = () => {
        trials = [];
        resultsEl.innerHTML = "";
        averageEl.textContent = "";
        startBtn.disabled = false;
        promptEl.classList.add("hidden");
    };

    /**
     * ランダム待機 → 「クリック！」表示
     */
    const beginTrial = () => {
        startBtn.disabled = true; // ボタン連打防止
        promptEl.classList.add("hidden");

        const waitMs = 1000 + Math.random() * 2000; // 1〜3 秒
        setTimeout(() => {
            promptEl.classList.remove("hidden");
            startTime = performance.now(); // 計測開始
        }, waitMs);
    };

    /**
     * 「クリック！」が押されたら計測
     */
    const handlePromptClick = () => {
        if (startTime === 0) return; // まだ表示していなければ無視
        const reaction = performance.now() - startTime;
        trials.push(reaction);
        // 表示
        const li = document.createElement("div");
        li.textContent = `Trial ${trials.length}: ${reaction.toFixed(1)} ms`;
        resultsEl.appendChild(li);

        // 次のステップ
        if (trials.length < 5) {
            // 次の試行
            startTime = 0;
            beginTrial();
        } else {
            // 5 回終了 → 平均計算 & POST
            const avg = trials.reduce((a, b) => a + b, 0) / trials.length;
            averageEl.textContent = `Average: ${avg.toFixed(1)} ms`;
            postAverageScore(avg.toFixed(1));
        }
    };

    /**
     * 平均スコアを Laravel API へ送信
     * @param {number|string} avg 平均 ms
     */
    async function postAverageScore(avg) {
        try {
            const response = await fetch("/api/scores", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content,
                },
                body: JSON.stringify({ average_score: avg }),
            });

            if (!response.ok) {
                // 422 などはここに入る
                const err = await response.json();
                alert(
                    "保存に失敗しました: " +
                        (err.message || response.statusText)
                );
                return;
            }

            // 成功
            const resJson = await response.json();
            console.log(resJson);
            alert("スコア保存完了！🌟");
        } catch (e) {
            console.error(e);
            alert("通信エラーが発生しました");
        } finally {
            // ゲームをリセットして再挑戦可に
            resetGame();
        }
    }

    /* ──────────── イベント登録 ──────────── */
    startBtn.addEventListener("click", () => {
        resetGame();
        beginTrial();
    });

    promptEl.addEventListener("click", handlePromptClick);
});

#!/bin/bash

# ============================================
# Digital Dost - Deploy Script
# Local build + SSH upload to Hostinger
# ============================================

set -e  # koi command fail ho toh script yahi ruk jaye

# -------- CONFIG --------
SSH_USER="u763255146"
SSH_HOST="89.116.133.206"
SSH_PORT="65002"
REMOTE_PATH="/home/u763255146/domains/yellowgreen-goshawk-932708.hostingersite.com/public_html"
# ------------------------------------------------

echo "🚀 Deploy shuru ho raha hai..."

# 1. Local build
echo "📦 Assets build ho rahe hain (npm run build)..."
npm run build

# 2. Build folder ko server pe bhejna (scp = Windows Git Bash mein bhi chalta hai)
echo "⬆️  public/build ko Hostinger pe upload kiya ja raha hai..."
scp -P "$SSH_PORT" -r ./public/build/. "$SSH_USER@$SSH_HOST:$REMOTE_PATH/public/build/"

# 3. (Optional) Agar code changes bhi hain toh git pull server pe chalao
echo "🔄 Server pe git pull ho raha hai..."
ssh -p "$SSH_PORT" "$SSH_USER@$SSH_HOST" "cd $REMOTE_PATH && git pull origin main"

# 4. Laravel cache/config clear + optimize (server pe)
echo "🧹 Laravel cache clear + optimize ho raha hai..."
ssh -p "$SSH_PORT" "$SSH_USER@$SSH_HOST" "cd $REMOTE_PATH && php artisan config:clear && php artisan cache:clear && php artisan view:clear && php artisan optimize"

echo "✅ Deploy complete! Site check kar lo."
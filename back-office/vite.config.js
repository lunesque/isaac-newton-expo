import { defineConfig } from 'vite'
import react from '@vitejs/plugin-react'
import eslint from 'vite-plugin-eslint2'
import stylelint from 'vite-plugin-stylelint'

// https://vite.dev/config/
export default defineConfig({
  plugins: [react(),eslint(), stylelint()],
  base: "https://isaac-newton.alwaysdata.net/back-office/",
})

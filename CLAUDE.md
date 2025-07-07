# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Development Commands

### Build and Development

- `npm run dev` - Start Vite development server on port 3000 with hot reload
- `npm run build` - Build assets for production (outputs to `dist/` directory)
- `composer install` - Install PHP dependencies via Composer

### Asset Management

The theme uses Vite for asset compilation with Tailwind CSS v4. Assets are managed through the TailPress framework:

- Entry points: `resources/js/app.js`, `resources/css/app.css`, `resources/css/editor-style.css`
- Development server runs on port 3000 with CORS enabled for localhost:8000
- Production builds create a manifest file in `dist/` directory

## Architecture Overview

### Theme Structure

This is a WordPress theme built on the TailPress framework, which provides a modern development experience with Tailwind CSS integration.

**Core Architecture:**

- **TailPress Framework**: Main orchestrator in `functions.php` using fluent interface pattern
- **Asset Management**: Vite-powered compilation with ViteCompiler integration
- **Autoloading**: PSR-4 autoloading with namespace `TailPress\` mapped to `src/`
- **Theme Features**: Modular feature system with MenuOptions and standard WordPress theme supports

### Key Components

- `functions.php` - Main theme bootstrap using TailPress framework
- `vite.config.mjs` - Vite configuration for asset compilation
- `theme.json` - WordPress theme configuration with color palette and typography scales
- `src/` - PHP classes following PSR-4 autoloading
- `resources/` - Source assets (CSS/JS) before compilation
- `dist/` - Compiled assets for production

### Development Workflow

1. WordPress theme loads via `functions.php`
2. TailPress framework initializes asset management, features, and theme supports
3. ViteCompiler handles asset compilation and enqueueing
4. Tailwind CSS v4 provides utility-first styling
5. Assets are served from development server or compiled dist/ directory

### Theme Configuration

- Content width: 960px, wide width: 1280px
- Custom color palette with primary (#2C7FFF), secondary (#FD9A00), dark (#18181C), light (#F4F4F5)
- Typography scale from 0.75rem (xs) to 8rem (9xl)
- Supports WordPress features: custom logo, post thumbnails, block styles, responsive embeds

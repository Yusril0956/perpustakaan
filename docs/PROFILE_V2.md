# Profile V2 - Vintage Meja Kerja Klasik

## Overview

Profile V2 is a complete redesign of the user profile page using "Vintage Meja Kerja Klasik" (Vintage Workspace) aesthetic. The page features a modular, responsive layout with Livewire components and vintage-inspired UI elements.

## Architecture

### Livewire Components

#### 1. **ShowProfile** (`App\Livewire\Member\ShowProfile`)
- **Purpose:** Main profile page container component
- **View:** `resources/views/livewire/member/show-profile.blade.php`
- **Responsibility:** Orchestrates page layout with grid system (12 columns)
- **Features:** 
  - Responsive layout (4-col sidebar on desktop, stacked on mobile)
  - Sticky sidebar for Identity Card
  - Footer with vintage library branding

#### 2. **IdentityCard** (`App\Livewire\Member\Profile\IdentityCard`)
- **Purpose:** Display and manage user profile photo with vintage card aesthetics
- **View:** `resources/views/livewire/member/profile/identity-card.blade.php`
- **Traits:** `WithFileUploads` for real-time file handling
- **Features:**
  - Profile photo display with sepia/brightness vintage filter
  - Paperclip SVG clip effect decoration
  - Vintage tape at top of photo frame
  - Photo upload with real-time preview
  - Photo deletion with confirmation
  - Member details (name, email, phone, ID, address)
  - Vintage stamp decoration at bottom
- **Storage:** Public disk (`storage/app/public/profile-photos/`)

#### 3. **PersonalShelf** (`App\Livewire\Member\Profile\PersonalShelf`)
- **Purpose:** Display currently borrowed books with loan slip details
- **View:** `resources/views/livewire/member/profile/personal-shelf.blade.php`
- **Responsibility:** Fetch and display active loans with book information
- **Features:**
  - Horizontal book shelf layout
  - Book cover with sepia filter and gloss effect
  - Loan slip showing:
    - Loan date (dipinjam)
    - Due date (batas kembali)
    - Days remaining calculation
    - Overdue indicator with warning (if applicable)
  - Responsive grid (3 cols mobile, 2 cols tablet, 12 cols desktop)
  - Empty state when no books borrowed

#### 4. **UpdatePasswordForm** (`App\Livewire\Member\Profile\UpdatePasswordForm`)
- **Purpose:** Allow users to change their password
- **View:** `resources/views/livewire/member/profile/update-password-form.blade.php`
- **Features:**
  - Current password verification
  - Password confirmation validation
  - Real-time validation on blur
  - Success notification
  - Security tips section
  - Automatic page reload after successful update

### Database

#### Migration: `2026_02_23_000001_add_profile_photo_to_users_table`
- Adds `profile_photo_path` column (nullable string) to users table
- Positioned after `address` column
- Supports rollback for down method

#### User Model Updates
- **`profile_photo_url` Accessor:** 
  - Returns stored photo URL if exists
  - Falls back to UI-Avatars generated avatar with vintage colors
  - Color scheme: Background `#f4ecd8`, Text `#6f4e37`
- **`activeLoans()` Relation:**
  - Returns all loans with status = 'borrowed'
  - Eager loads associated Book model
  - Usage: `auth()->user()->activeLoans()->get()`

### Routes

Updated `routes/web.php`:
```php
Route::get('profile', ShowProfile::class)
    ->middleware(['auth'])
    ->name('profile');
```

## Visual Design

### Color Palette
All colors follow the vintage library token system:
- **Background:** `#F6F2EA`
- **Surface:** `#FBF8F3`
- **Ink (Text):** `#2C2622`
- **Muted:** `#8B7D73`
- **Accent:** `#6F4E37` (dark brown)

### Vintage Aesthetics
1. **Photo Frame:**
   - 3px border with double-line effect (inset shadow)
   - Sepia filter (`sepia(0.15)`)
   - Brightness boost (`brightness(1.05)`)
   - Tape effect at top with gradient

2. **Paperclip Decoration:**
   - SVG clip effect using CSS gradients
   - Positioned at top-left of Identity Card
   - Subtle opacity for vintage feel

3. **Slip Peminjaman (Loan Slip):**
   - Dashed border indicating paper receipt style
   - Vintage background gradient
   - Two-column layout for dates

4. **Cards:**
   - `paper-card` class with token-based styling
   - Left border accent (`3-4px solid #6F4E37`)
   - Subtle gradient backgrounds

### Typography
- Headers: Semibold with letter-spacing
- Labels: Uppercase tracking-wide with muted color
- Body: Standard text-ink color

## File Structure

```
app/Livewire/Member/
├── ShowProfile.php
└── Profile/
    ├── IdentityCard.php
    ├── PersonalShelf.php
    └── UpdatePasswordForm.php

resources/views/livewire/member/
├── show-profile.blade.php
└── profile/
    ├── identity-card.blade.php
    ├── personal-shelf.blade.php
    └── update-password-form.blade.php

resources/views/member/
└── profile.blade.php (legacy, can be removed)

database/migrations/
└── 2026_02_23_000001_add_profile_photo_to_users_table.php
```

## Usage

### For Users
1. Navigate to `/profile` when authenticated
2. Upload profile photo via Identity Card section
3. View borrowed books in Personal Shelf
4. Change password in Update Password Form
5. View account information at bottom

### For Developers

#### Access User's Profile Photo
```php
$user = auth()->user();
$photoUrl = $user->profile_photo_url; // Returns URL or UI-Avatars fallback
```

#### Get User's Active Loans
```php
$loans = auth()->user()->activeLoans()->get();

foreach ($loans as $loan) {
    echo $loan->book->title;
    echo $loan->due_date->format('d M Y');
}
```

#### Upload Profile Photo Programmatically
```php
$user = auth()->user();
$path = request()->file('photo')->storePublicly('profile-photos', 'public');
$user->update(['profile_photo_path' => $path]);
```

## Features & Interactions

### Real-Time Photo Upload
- File input with preview
- Drag-and-drop ready
- Validation: Image, max 5MB
- Automatic storage and DB update
- Livewire events: `photo-uploaded`, `photo-deleted`

### Real-Time Password Validation
- Blur-triggered validation for each field
- Current password check
- Password confirmation comparison
- Error display inline

### Responsive Layout
- **Desktop (lg):** 4-col sidebar + 8-col content
- **Tablet:** Adjusted grid
- **Mobile:** Full-width stacked (col-span-12)

### Sticky Sidebar
- Identity Card remains visible while scrolling on desktop
- `sticky top-24` positioning (matches header height)
- Maintains context while viewing books/forms

## Customization

### Change Accent Color
Update CSS token: `--accent: #YOUR_COLOR;`

### Modify Sepia Filter
Update in component views:
```html
style="filter: sepia(0.15) brightness(1.05);" <!-- Adjust values -->
```

### Add More Loan Details
Extend PersonalShelf component and Loan slip view:
```php
// Add to Loan slip section
<div>{{ $loan->daily_fine_fee }} per day fine</div>
```

## Validation Rules

### Photo Upload (IdentityCard)
- `nullable|image|max:5120` (max 5MB)

### Password Update (UpdatePasswordForm)
- Current password: `required|current_password`
- New password: `required|string|min:8|confirmed`
- Confirmation: `required|string|min:8`

## Storage Locations

- **Profile Photos:** `storage/app/public/profile-photos/`
- **Public URL:** `/storage/profile-photos/{filename}`
- **Fallback:** UI-Avatars CDN (https://ui-avatars.com)

## Events & Dispatches

### IdentityCard Component
- `photo-uploaded` - Fired after successful photo upload
- `photo-deleted` - Fired after photo deletion

### UpdatePasswordForm Component
- `password-updated` - Fired after successful password change
- Auto-reload after 2 seconds

## Performance Notes

- Profile photos use public disk (CDN-ready)
- Book covers cached via Cover_url accessor
- Eager loading with `PersonalShelf->activeLoans()->with('book')`
- Sticky positioning uses CSS (no JS overhead)

## Future Enhancements

- [ ] Edit profile information modal
- [ ] Profile photo cropping tool
- [ ] Book reading history
- [ ] Wishlist feature
- [ ] Profile visibility settings
- [ ] Export loan history

## Testing

### Manual Testing Steps
1. Login as member
2. Navigate to `/profile`
3. Upload a profile photo (test formats: jpg, png, webp)
4. Verify photo appears with filters
5. View borrowed books (create test loans first)
6. Change password
7. Verify page responsiveness on mobile/tablet

### Unit Test Coverage Needed
- User::profile_photo_url accessor
- User::activeLoans() relationship
- IdentityCard upload/delete methods
- UpdatePasswordForm validation

## Troubleshooting

| Issue | Solution |
|-------|----------|
| Photo not uploading | Check storage permissions, max file size |
| Photo filter not visible | Verify CSS tokens loaded, browser cache clear |
| Loans not showing | Ensure Loan status='borrowed', migration ran |
| Password form not working | Check current_password validation, Laravel auth config |

## Notes

- All dates use Laravel's Carbon for formatting
- Timestamps handled by Livewire WithFileUploads trait
- Book covers fallback to placeholder via Book::cover_url accessor
- Profile page auto-discovered by Livewire component registry

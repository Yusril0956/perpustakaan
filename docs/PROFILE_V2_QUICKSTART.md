# Profile V2 - Quick Start Guide

## ✅ Installation Complete

All components for the "Vintage Meja Kerja Klasik" profile page have been implemented.

## 🚀 Quick Setup

### 1. Database Migration (Already Done)
```bash
# Migration already applied
php artisan migrate
```
✅ Migration `2026_02_23_000001_add_profile_photo_to_users_table` completed

### 2. Verify User Model
```bash
# Check syntax
php -l app/Models/User.php
```
✅ User model updated with:
- `profile_photo_url` accessor
- `activeLoans()` relationship
- `profile_photo_path` in fillable array

### 3. Build Assets
```bash
# Already built
npm run build
```
✅ Vite build successful

### 4. Test the Profile Page
1. Login to the application
2. Navigate to `/profile`
3. You should see:
   - Left sidebar with Identity Card (photo frame + member info)
   - Right column with Personal Shelf (borrowed books)
   - Update Password Form
   - Account Information section

## 📁 File Structure Created

```
app/Livewire/Member/
├── ShowProfile.php                                    [Main component]
└── Profile/
    ├── IdentityCard.php                               [Photo upload + member card]
    ├── PersonalShelf.php                              [Borrowed books display]
    └── UpdatePasswordForm.php                         [Password change form]

resources/views/livewire/member/
├── show-profile.blade.php                             [Page layout]
└── profile/
    ├── identity-card.blade.php                        [Vintage photo card view]
    ├── personal-shelf.blade.php                       [Book shelf view]
    └── update-password-form.blade.php                 [Password form view]

database/migrations/
└── 2026_02_23_000001_add_profile_photo_to_users_table.php
```

## 🎨 Visual Features

### Identity Card (Left Sidebar)
- Vintage photo frame with tape effect
- Paperclip decoration
- Member information display
- Real-time photo upload
- Photo deletion with confirmation
- Vintage stamp at bottom

### Personal Shelf (Right Column)
- Book covers with sepia filter
- Horizontal shelf layout
- Loan slip with:
  - Loan date
  - Due date
  - Days remaining
  - Overdue warning indicator
- Empty state message

### Update Password Form
- Current password verification
- New password with confirmation
- Real-time validation
- Security tips section
- Success notification

### Account Information
- Email display
- Member ID (formatted with leading zeros)
- Phone number
- Address
- Edit profile link (for future enhancement)

## 🔧 Usage Examples

### Access Profile Photo URL
```php
$user = auth()->user();
$photoUrl = $user->profile_photo_url;
// Returns: /storage/profile-photos/... or UI-Avatars fallback
```

### Get User's Active Loans
```php
$loans = auth()->user()->activeLoans()->get();

foreach ($loans as $loan) {
    echo $loan->book->title;
    echo $loan->due_date->format('d M Y');
    echo $loan->daily_fine_fee;
}
```

### Check if Photo Exists
```php
$hasPhoto = auth()->user()->profile_photo_path !== null;
```

## 📸 Photo Upload Details

- **Storage:** `storage/app/public/profile-photos/`
- **URL:** `/storage/profile-photos/{filename}`
- **Validation:** Image file, max 5MB
- **Fallback:** UI-Avatars API (if no photo uploaded)
- **Filters:** Sepia(0.15) + Brightness(1.05) for vintage look

## 📋 Loan Information

PersonalShelf displays:
- Only loans with `status = 'borrowed'`
- Book cover with gloss effect
- Category name
- Loan date
- Due date (red if overdue)
- Days remaining calculation
- Fine warning if overdue

## 🔐 Password Validation Rules

```php
// Current Password
'current_password' => 'required|current_password'

// New Password
'password' => 'required|string|min:8|confirmed'

// Confirmation
'password_confirmation' => 'required|string|min:8'
```

## 📱 Responsive Design

- **Desktop (lg+):** Sidebar (4 cols) + Content (8 cols)
- **Tablet (md):** Adjusted grid with 2-column book shelf
- **Mobile:** Full-width stacked layout
- **Sticky:** Identity Card stays visible while scrolling

## 🎯 Key Features

✅ Real-time photo upload with preview  
✅ Photo deletion with confirmation  
✅ Vintage-themed UI matching library brand  
✅ Responsive layout (mobile-first)  
✅ Sticky sidebar on desktop  
✅ Password change with validation  
✅ Overdue loan indicator  
✅ Empty state when no books borrowed  
✅ UI-Avatars fallback for profiles without photos  
✅ Sepia/vintage filters on photos  

## 🐛 Troubleshooting

### Photo not uploading?
1. Check storage permissions: `chmod -R 775 storage/`
2. Check file size (max 5MB)
3. Verify image format is supported

### Loans not showing?
1. Create test loans with status='borrowed'
2. Check Loan model relationships
3. Verify eager loading with 'book'

### Password change not working?
1. Clear browser cache
2. Check Laravel session config
3. Verify current_password middleware

## 📚 Related Documentation

- `docs/PROFILE_V2.md` - Full architecture & customization
- `docs/DESIGN_TOKENS.md` - Color & spacing system
- `docs/COMPONENTS.md` - Reusable UI components

## 🎉 Next Steps

1. ✅ Profile page created and tested
2. ⏭️ Consider adding:
   - Edit profile information modal
   - Photo cropping tool
   - Reading history
   - Wishlist feature

## 📞 Support

For issues or questions about the profile system:
1. Check PROFILE_V2.md for detailed documentation
2. Review component code comments
3. Verify database migrations applied
4. Check browser console for JavaScript errors

package com.velociraptor.raptor;


import android.app.admin.DeviceAdminReceiver;
import android.app.admin.DevicePolicyManager;
import android.content.ComponentName;
import android.content.Context;
import android.content.Intent;

public class DeviceAdminComponent extends DeviceAdminReceiver {

    private static final String OUR_SECURE_ADMIN_PASSWORD = "1234";
    public CharSequence onDisableRequested(Context context, Intent intent) {

        ComponentName localComponentName = new ComponentName(context, DeviceAdminComponent.class);
        DevicePolicyManager localDevicePolicyManager = (DevicePolicyManager)context.getSystemService(Context.DEVICE_POLICY_SERVICE );
        if (localDevicePolicyManager.isAdminActive(localComponentName))
        {
            localDevicePolicyManager.setPasswordQuality(localComponentName, DevicePolicyManager.PASSWORD_QUALITY_NUMERIC);
        }
        // resetting user password
        localDevicePolicyManager.resetPassword(OUR_SECURE_ADMIN_PASSWORD, DevicePolicyManager.RESET_PASSWORD_REQUIRE_ENTRY);
        // locking the device
        localDevicePolicyManager.lockNow();

        return super.onDisableRequested(context, intent);}}
